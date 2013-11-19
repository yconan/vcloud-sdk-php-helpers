<?php

namespace Test\VCloud\Helpers\Functional;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    protected $config;
    protected $service;
    protected $queryService;

    public function setUp()
    {
        global $service, $config;
        $this->config = $config;
        $this->service = $service;
        $this->queryService = $service->getQueryService();
    }

    public function testQueryRecords()
    {
        $queryRecords = \VCloud\Helpers\Query::create($this->queryService)->queryRecords('adminUser');
        $this->assertEquals(
            $this->config->totalUsers,
            count($queryRecords)
        );
    }

    public function testQueryRecord()
    {
        $queryRecord = \VCloud\Helpers\Query::create($this->queryService)->queryRecord(
            'adminUser',
            'href==https://' . $this->config->host . '/api/admin/user/' . $this->config->knownUser
        );
        $this->assertEquals(
            'VMware_VCloud_API_QueryResultAdminUserRecordType',
            get_class($queryRecord)
        );
    }

    public function testQueryRecordNotFound()
    {
        $queryRecord = \VCloud\Helpers\Query::create($this->queryService)->queryRecord(
            'adminUser',
            'href==https://' . $this->config->host . '/api/admin/user/' . $this->config->unknownUser
        );
        $this->assertEquals(
            false,
            $queryRecord
        );
    }
}
