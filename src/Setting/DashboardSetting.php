<?php

namespace LightAdminTheme\Setting;

use LightAdminTheme\Field\AddCustomBoxField;
use LightAdminTheme\Field\HideDefaultBoxedField;
use LightAdminTheme\Field\HideWelcomeField;
use LightAdminTheme\Field\LogoField;

class DashboardSetting extends Setting
{
    public function __construct()
    {
        $this->fields = [
            new HideWelcomeField(),
            new HideDefaultBoxedField(),
            new AddCustomBoxField(),
            new LogoField()
        ];
    }

    public function getSlug()
    {
        return "lat_dashboard";
    }

    public function getName()
    {
        return "Dashboard";
    }
}