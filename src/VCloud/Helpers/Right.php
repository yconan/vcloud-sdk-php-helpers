<?php

namespace VCloud\Helpers;

class Right
{
    protected $service;
    protected $currentUserRights;

    public function __construct(\VMware_VCloud_SDK_Service $service)
    {
        $this->service = $service;
    }

    public static function create(\VMware_VCloud_SDK_Service $service)
    {
        return new self($service);
    }

    public function isCurrentUserOrganizationAdmin()
    {
        return $this->hasCurrentUserRight('Organization / Manage');
    }

    public function hasCurrentUserRights($rights)
    {
        foreach ($rights as $right) {
            if (!$this->hasCurrentUserRight($right)) {
                return false;
            }
        }
        return true;
    }

    public function hasCurrentUserRight($right)
    {
        if (is_string($right)) {
            $right = $this->getRightByName($right);
        }

        $id = $right->get_id();
        foreach ($this->getCurrentUserRights() as $r) {
            if ($r->get_id() === $id) {
                return true;
            }
        }
    }
}
