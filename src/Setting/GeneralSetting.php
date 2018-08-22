<?php

namespace LightAdminTheme\Setting;

use LightAdminTheme\Field\LightThemeField;

class GeneralSetting extends Setting
{
    public function __construct()
    {
        $this->fields = [
            new LightThemeField(),
        ];
    }

    public function getSlug()
    {
        return "lat_general";
    }

    public function getName()
    {
        return "General";
    }
}