<?php

namespace LightAdminTheme\Field;

use LightAdminTheme\Action\RemoveWordPressLogoAction;
use LightAdminTheme\Option\Checkbox;

class RemoveWordPressLogoField extends Field
{
    public function prepareAction()
    {
        if (!empty($this->getValue())) {
            add_action('wp_after_admin_bar_render', [
                new RemoveWordPressLogoAction(), "doAction"
            ]);
        }
    }

    public function getWhere()
    {
        return Where::ADMIN;
    }

    public function getName()
    {
        return "Remove WordPress logo";
    }

    public function getSlug()
    {
        return "lat_removeWordPressLogo";
    }

    public function getType()
    {
        return Checkbox::class;
    }
}