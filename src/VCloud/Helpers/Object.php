<?php

namespace VCloud\Helpers;

class Object
{
    /**
     * Create a vCloud SDK for PHP reference
     * @param string $type Object type
     * @param string $href Href of the object
     * @param string $name Name of the object
     */
    public static function createReference($type, $href, $name = null)
    {
        $object = new VMware_VCloud_API_ReferenceType();
        $object->set_href($href);
        if ($name != null) {
            $object->set_name($name);
        }
        $object->set_type('application/vnd.vmware.vcloud.' . $type . '+xml');
        return $object;
    }
}
