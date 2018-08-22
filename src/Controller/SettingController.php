<?php

namespace LightAdminTheme\Controller;

use LightAdminTheme\LightAdminTheme;
use LightAdminTheme\Manager\OptionManager;
use LightAdminTheme\Setting\SettingInterface;

class SettingController
{
    /**
     * @var OptionManager
     */
    private $optionManager;
    private $settings;

    public function __construct(OptionManager $optionManager, $settings)
    {
        add_action('admin_menu', [$this, 'settingsMenu']);

        $this->optionManager = $optionManager;
        $this->settings = $settings;

        $this->optionManager->setOptions();

        if (!empty($_POST) and !empty($_POST["lat-update"])) {
            add_action('admin_init', [$this, "save"]);
        }
    }

    public function settingsMenu()
    {
        add_options_page(
            LightAdminTheme::NAME,
            LightAdminTheme::NAME,
            'manage_options',
            LightAdminTheme::SLUG,
            [$this, 'settingsPage']
        );
    }

    public function settingsPage()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        register_setting(LightAdminTheme::SLUG, LightAdminTheme::NAME);

        /** @var SettingInterface $setting */
        foreach ($this->settings as $setting) {
            $setting->addSection();
        }

        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()); ?></h1>
            <form action="#" method="post">
                <input type="hidden" name="lat-update" value="1"/>
                <?php
                settings_fields(LightAdminTheme::SLUG);
                do_settings_sections(LightAdminTheme::SLUG);
                submit_button(__('Save Settings', LightAdminTheme::SLUG));
                ?>
            </form>
        </div>
        <?php
    }

    public function save()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        if (!empty($_POST)) {
            /** @var SettingInterface $setting */
            foreach ($this->settings as $setting) {
                foreach ($setting->getFields() as $field) {
                    $field->setValue(null);
                }

                $group = $setting->getSlug();


                $data = $this->optionManager->getOptions($group, true);

                if (!empty($_POST[$group])) {
                    $data = array_merge($data, $_POST[$group]);
                }

                update_option($group, $data);
            }

            $this->refresh();
        }
    }

    private function refresh()
    {
        $actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("location: $actualLink");
        exit;
    }
}