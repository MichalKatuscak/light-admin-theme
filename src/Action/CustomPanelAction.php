<?php

namespace LightAdminTheme\Action;

class CustomPanelAction implements ActionInterface
{
    public function doAction()
    {
        wp_add_dashboard_widget(
            'lat_dashboard',
            get_bloginfo("name"),
            array($this, "customPanelEcho")
        );
    }

    public function customPanelEcho()
    {
        $options = get_option("lat_dashboard");

        if (!empty($options["logo"])) {
            echo "
        <center>
            <img src='" . wp_get_attachment_url($options["logo"]) . "' style='margin:0 auto;padding: 30px 0;width:auto;height:auto;max-width: 250px;max-height:75px'>
        </center>
        ";
        }
        echo "
        <center>
            <div style='line-height: 22px; color: #42C1E7; font-size: 16px;padding-top:6px;'>
                " . get_bloginfo("description") . "
            </div>
        </center>
    ";

    }
}