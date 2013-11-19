<?php

namespace Test\VCloud\Helpers\Unit;

class ExceptionTestCase extends \PHPUnit_Framework_TestCase
{
    protected $e;

    public function setUp()
    {
        $this->e = new \VMware_VCloud_SDK_Exception(file_get_contents(__DIR__ . '/_files/Error.xml'));
    }

    public function testGetOriginalException()
    {
        $this->assertEquals($this->e, \VCloud\Helpers\Exception::create($this->e)->getOriginalException());
    }

    public function testGetMessage()
    {
        $this->assertEquals(
            'The requested operation could not be executed because media '
            . '"reconfMedia-vm-69cfa436-a55c-4045-be62-f110bbb5801d_1372317643" '
            . 'is mounted by VM(s): "__e2cLBHA__Production_m_1372316882".  Please '
            . 'eject media from the VM(s) before deleting media.',
            \VCloud\Helpers\Exception::create($this->e)->getMessage()
        );
    }

    public function testGetMajorErrorCode()
    {
        $this->assertEquals(
            '400',
            \VCloud\Helpers\Exception::create($this->e)->getMajorErrorCode()
        );
    }

    public function testGetMinorErrorCode()
    {
        $this->assertEquals(
            'BAD_REQUEST',
            \VCloud\Helpers\Exception::create($this->e)->getMinorErrorCode()
        );
    }

    public function testGetStackTrace()
    {
        $this->assertEquals(
            175,
            count(explode("\n", \VCloud\Helpers\Exception::create($this->e)->getStackTrace()))
        );
    }
}
