<?php

namespace VCloud\Helpers;

class Query
{
    const DEFAULT_PAGE_SIZE = 128;

    protected $queryService;
    protected $pageSize;

    public function __construct(\VMware_VCloud_SDK_Query $queryService, $pageSize = self::DEFAULT_PAGE_SIZE)
    {
        $this->queryService = $queryService;
        $this->pageSize = $pageSize;
    }

    public static function create(\VMware_VCloud_SDK_Query $queryService)
    {
        return new self($queryService);
    }

    protected function isLastRecordsPage(\VMware_VCloud_API_QueryResultRecordsType $records)
    {
        foreach ($records->getLink() as $link) {
            if ($link->get_rel() === 'lastPage')
            {
                return false;
            }
        }
        return true;
    }

    protected function queryRecordsPage($type, $filter, $page)
    {
        $params = new VMware_VCloud_SDK_Query_Params();
        $params->setPageSize($this->pageSize);
        $params->setPage($page);

        if ($filter !== null) {
            $params->setFilter($filter);
        }

        return $this->queryService->queryRecords($type, $params);
    }

    public function queryRecords($type, $filter = null)
    {
        $allRecords = array();
        for ($page = 0, $records = null; $records === null || $this->isLastRecordsPage($records); $page++) {
            $records = $this->queryRecordsPage($type, $filter, $page);
            $allRecords = array_merge($allRecords, $records->getRecord());
        }
        return $allRecords;
    }

    public function queryRecord($type, $filter = null)
    {
        $records = $this->queryRecordsPage($type, $filter, $page)->getRecord();
        return isset(count($records) > 0) ? $records[0] : false;
    }
}
