<?php

use VCloud\Helpers\Exception as ExceptionHelper;
use VMware\VCloud\SDK\Exception as SDKException;

class ExceptionUnitTestCase extends PHPUnit_Framework_TestCase
{
    protected $e;

    public function setUp()
    {
        $this->e = new SDKException(file_get_contents(__DIR__ . '/_files/Error.xml'));
    }

	public function testGetMessage()
	{
		$this->assertEquals(
            'The requested operation could not be executed because media "reconfMedia-vm-69cfa436-a55c-4045-be62-f110bbb5801d_1372317643" is mounted by VM(s): "__e2cLBHA__Production_m_1372316882".  Please eject media from the VM(s) before deleting media." majorErrorCode="400" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance',
            ExceptionHelper::create($this->e)->getMessage()
        );
	}
}
