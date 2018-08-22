<?php

namespace LightAdminTheme\Field;

use LightAdminTheme\Action\CustomPanelAction;
use LightAdminTheme\Option\Media;

class LogoField extends Field
{
    public function prepareAction()
    {
        if (!empty($this->getValue())) {
            echo "
                <style>
                    .login h1 a {
                        width:100%;
                        background: url('".wp_get_attachment_url($this->getValue()) ."') no-repeat top center / contain;
                    }
                </style>
            ";
        }
    }

    public function getWhere()
    {
        return Where::LOGIN;
    }

    public function getName()
    {
        return "Logo";
    }

    public function getSlug()
    {
        return "logo";
    }

    public function getType()
    {
        return Media::class;
    }
}