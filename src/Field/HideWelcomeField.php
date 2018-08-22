<?php

namespace LightAdminTheme\Field;

use LightAdminTheme\Option\Checkbox;

class HideWelcomeField extends Field
{
    public function prepareAction()
    {
        if (!empty($this->getValue())) {
            remove_action('welcome_panel', 'wp_welcome_panel');
        }
    }

    public function getWhere()
    {
        return Where::ADMIN;
    }

    public function getName()
    {
        return "Hide Welcome panel";
    }

    public function getSlug()
    {
        return "lat_hideWelcome";
    }

    public function getType()
    {
        return Checkbox::class;
    }
}