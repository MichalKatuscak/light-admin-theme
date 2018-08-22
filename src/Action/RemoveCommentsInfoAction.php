<?php

namespace LightAdminTheme\Action;

class RemoveCommentsInfoAction implements ActionInterface
{
    public function doAction()
    {
        echo "<style>#wp-admin-bar-comments {display: none!important; }</style>";
    }
}