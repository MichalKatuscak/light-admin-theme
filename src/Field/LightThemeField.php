<?php

namespace LightAdminTheme\Field;

use LightAdminTheme\LightAdminTheme;
use LightAdminTheme\Option\Checkbox;

class LightThemeField extends Field
{
    public function prepareAction()
    {
        if (!empty($this->getValue())) {
            wp_enqueue_style(
                'theme',
                plugins_url('../../assets/css/theme.css', __FILE__),
                [],
                LightAdminTheme::VERSION,
                'all'
            );
        }
    }

    public function getWhere()
    {
        return Where::ADMIN;
    }

    public function getName()
    {
        return "Use light theme";
    }

    public function getSlug()
    {
        return "lat_useLightTheme";
    }

    public function getType()
    {
        return Checkbox::class;
    }
}