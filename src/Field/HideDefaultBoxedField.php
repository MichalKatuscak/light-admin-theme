<?php

namespace LightAdminTheme\Field;

use LightAdminTheme\Action\CustomPanelAction;
use LightAdminTheme\Action\RemoveDefaultPanelsAction;
use LightAdminTheme\Option\Checkbox;

class HideDefaultBoxedField extends Field
{
    public function prepareAction()
    {
        if (!empty($this->getValue())) {
            add_action('wp_dashboard_setup', [
                new RemoveDefaultPanelsAction(), "doAction"
            ], 9999999);
        }
    }

    public function getWhere()
    {
        return Where::ADMIN;
    }

    public function getName()
    {
        return "Hide default boxes";
    }

    public function getSlug()
    {
        return "lat_hideDefaultBoxes";
    }

    public function getType()
    {
        return Checkbox::class;
    }
}