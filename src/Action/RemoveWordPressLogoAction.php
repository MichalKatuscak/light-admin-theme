<?php

namespace LightAdminTheme\Action;

class RemoveWordPressLogoAction implements ActionInterface
{
    public function doAction()
    {
        echo "<style>#wp-admin-bar-wp-logo {display: none!important; }</style>";
    }
}