<?php

namespace LightAdminTheme\Option;

use LightAdminTheme\LightAdminTheme;

class Checkbox implements OptionInterface
{
    public function render($args)
    {
        echo $this->getHtml($args);
    }

    private function getHtml($args)
    {
        $args["option"] = esc_html($args["option"]);
        $args["group"] = esc_html($args["group"]);
        $args["value"] = esc_html($args["value"]);

        $label = !empty($args["label"]) ? $args["label"] : __("Yes", LightAdminTheme::SLUG);
        $label = esc_html($label);

        $html = '<input type="checkbox" 
            id="' . $args["group"] . '-' . $args["option"] . '" 
            name="' . $args["group"] . '[' . $args["option"] . ']" 
            value="1"' . checked(1, $args["value"], false) . '/>';
        $html .= '<label for="' . $args["group"] . '-' . $args["option"] . '">'.$label.'</label>';

        return $html;
    }
}