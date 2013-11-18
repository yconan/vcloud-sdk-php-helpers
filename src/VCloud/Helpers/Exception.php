<?php

namespace VCloud\Helpers;

use \VMware\VCloud\SDK\Exception as SDKException;

class Exception
{
    protected $originalException;
    protected $document;

    public function __construct(SDKException $originalException)
    {
        $this->originalException = $originalException;
        $this->$document = new SimpleXMLElement($e->getMessage());
    }

    public static function create(SDKException $originalException)
    {
        return new self($originalException);
    }

    public function getOriginalException()
    {
        return $this->originalException;
    }

    public function getMessage()
    {
        return $this->document->message;
    }

    public function getMajorErrorCode()
    {
        return $this->document->majorErrorCode;
    }

    public function getMinorErrorCode()
    {
        return $this->document->minorErrorCode;
    }

    public function getVendorSpecificErrorCode()
    {
        return $this->document->vendorSpecificErrorCode;
    }

    public function getStackTrace()
    {
        return $this->document->stackTrace;
    }
}
