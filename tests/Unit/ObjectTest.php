<?php

namespace Test\VCloud\Helpers\Unit;

class ObjectTest extends \PHPUnit_Framework_TestCase
{
    const TYPE = 'adminUser';
    const MIME = 'application/vnd.vmware.vcloud.adminUser+xml';
    const HREF = 'https://vcloud-director.local/api/admin/user/23d6deb1-1778-4325-8289-2f150d122674';
    const NAME = 'yconan';

    public function testCreateReferenceWithoutName()
    {
        $reference = \VCloud\Helpers\Object::createReference('adminUser', self::HREF);
        $this->assertEquals('VMware_VCloud_API_ReferenceType', get_class($reference));
        $this->assertEquals(self::MIME, $reference->get_type());
        $this->assertEquals(self::HREF, $reference->get_href());
    }

    public function testCreateReferenceWithName()
    {
        $reference = \VCloud\Helpers\Object::createReference('adminUser', self::HREF, self::NAME);
        $this->assertEquals('VMware_VCloud_API_ReferenceType', get_class($reference));
        $this->assertEquals(self::MIME, $reference->get_type());
        $this->assertEquals(self::HREF, $reference->get_href());
        $this->assertEquals(self::NAME, $reference->get_name());
    }
}
