<?php

namespace LightAdminTheme\Field;

use LightAdminTheme\Action\RemoveCommentsInfoAction;
use LightAdminTheme\Option\Checkbox;

class RemoveCommentsInfoField extends Field
{
    public function prepareAction()
    {
        if (!empty($this->getValue())) {
            add_action('wp_after_admin_bar_render', [
                new RemoveCommentsInfoAction(), "doAction"
            ]);
        }
    }

    public function getWhere()
    {
        return Where::ADMIN;
    }

    public function getName()
    {
        return "Remove comments information";
    }

    public function getSlug()
    {
        return "lat_removeComment";
    }

    public function getType()
    {
        return Checkbox::class;
    }
}