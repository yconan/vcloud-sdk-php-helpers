<?php

namespace Test\VCloud\Helpers\Unit\Stub;

class QueryService extends \VMware_VCloud_SDK_Query
{
    public function __construct()
    {
    }

    public function queryRecords($type, $params = null)
    {
        $paramsArray = $params->getParams();
        $filename = __DIR__ . '/../_files/';
        switch ($paramsArray['filter']) {
            case null:
                $filename .= 'Query' . $paramsArray['page'] . '.xml';
                break;
            case 'href==https://vcloud-director.local/api/admin/user/23d6deb1-1778-4325-8289-2f150d122674':
                $filename .= 'QueryFilter.xml';
                break;
            default:
                $filename .= 'QueryFilterNoResult.xml';
                break;
        }

        $xml = file_get_contents($filename);
        if (!$xml) {
            throw new \Exception('Failed reading XML from file ' . $filename);
        }

        $records = \VMware_VCloud_API_Helper::parseString($xml, $type = '\VMware_VCloud_API_QueryResultRecordsType');
        return $records;
    }
}
