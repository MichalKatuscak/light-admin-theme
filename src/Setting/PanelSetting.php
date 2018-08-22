<?php

namespace LightAdminTheme\Setting;

use LightAdminTheme\Field\RemoveCommentsInfoField;
use LightAdminTheme\Field\RemoveWordPressLogoField;

class PanelSetting extends Setting
{
    public function __construct()
    {
        $this->fields = [
            new RemoveWordPressLogoField(),
            new RemoveCommentsInfoField(),
        ];
    }

    public function getSlug()
    {
        return "lat_panel";
    }

    public function getName()
    {
        return "Top panel";
    }
}