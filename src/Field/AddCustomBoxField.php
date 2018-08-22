<?php

namespace LightAdminTheme\Field;

use LightAdminTheme\Action\CustomPanelAction;
use LightAdminTheme\Option\Checkbox;

class AddCustomBoxField extends Field
{
    public function prepareAction()
    {
        if (!empty($this->getValue())) {
            add_action('wp_dashboard_setup', [
                new CustomPanelAction(), "doAction"
            ]);
        }
    }

    public function getWhere()
    {
        return Where::ADMIN;
    }

    public function getName()
    {
        return "Add box with logo and title";
    }

    public function getSlug()
    {
        return "lat_addCustomBox";
    }

    public function getType()
    {
        return Checkbox::class;
    }
}