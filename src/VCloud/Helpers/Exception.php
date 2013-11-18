<?php

namespace VCloud\Helpers;

class Exception
{
    protected $originalException;
    protected $document;

    public function __construct(\VMware_VCloud_SDK_Exception $originalException)
    {
        $this->originalException = $originalException;
        $this->document = new \SimpleXMLElement($originalException->getMessage());
    }

    public static function create(\VMware_VCloud_SDK_Exception $originalException)
    {
        return new self($originalException);
    }

    public function getOriginalException()
    {
        return $this->originalException;
    }

    public function getMessage()
    {
        return $this->document->attributes()->message->__toString();
    }

    public function getMajorErrorCode()
    {
        return $this->document->attributes()->majorErrorCode->__toString();
    }

    public function getMinorErrorCode()
    {
        return $this->document->attributes()->minorErrorCode->__toString();
    }

    public function getVendorSpecificErrorCode()
    {
        return $this->document->attributes()->vendorSpecificErrorCode->__toString();
    }

    public function getStackTrace()
    {
        return $this->document->attributes()->stackTrace->__toString();
    }
}
