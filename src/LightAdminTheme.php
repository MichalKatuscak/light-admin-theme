<?php

namespace LightAdminTheme;

use LightAdminTheme\Controller\SettingController;
use LightAdminTheme\Field\FieldInterface;
use LightAdminTheme\Field\Where;
use LightAdminTheme\Manager\OptionManager;
use LightAdminTheme\Setting\DashboardSetting;
use LightAdminTheme\Setting\GeneralSetting;
use LightAdminTheme\Setting\PanelSetting;
use LightAdminTheme\Setting\SettingInterface;

class LightAdminTheme
{
    const VERSION = "0.3";
    const NAME = "Light Admin Theme";
    const SLUG = "light-admin-theme";

    private $settings, $optionManager;

    public function __construct()
    {

        $settings = [
            new GeneralSetting(),
            new DashboardSetting(),
            new PanelSetting()
        ];

        $optionManager = new OptionManager($settings);
        new SettingController($optionManager, $settings);

        $this->optionManager = $optionManager;
        $this->settings = $settings;

        add_action('admin_init', [$this, "runAdmin"]);
        add_action('init', [$this, "runFront"]);
        add_action('login_head', [$this, 'runLogin']);

        add_filter('plugin_action_links', [$this, "pluginLink"], 10, 2);
    }

    public function runAdmin()
    {
        wp_enqueue_media();

        $this->run(Where::ADMIN);
    }

    public function runFront()
    {
        $this->run(Where::FRONT);
    }

    public function runLogin()
    {
        $this->run(Where::LOGIN);
    }

    private function run($where)
    {
        /** @var SettingInterface $setting */
        foreach ($this->settings as $setting) {
            /** @var FieldInterface $field */
            foreach ($setting->getFields() as $field) {
                if ($where === $field->getWhere()) {
                    $field->prepareAction();
                }
            }
        }
    }

    public function pluginLink($links, $file)
    {
        if ($file === 'light-admin-theme/light-admin-theme.php' && current_user_can('manage_options')) {
            $settings_link = sprintf('<a href="%s">%s</a>', admin_url('options-general.php?page=light-admin-theme'), __('Settings', 'classic-editor'));
            array_unshift($links, $settings_link);
        }

        return $links;
    }
}