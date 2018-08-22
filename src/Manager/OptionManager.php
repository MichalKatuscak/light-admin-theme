<?php

namespace LightAdminTheme\Manager;

use LightAdminTheme\Field\FieldInterface;
use LightAdminTheme\Setting\SettingInterface;

class OptionManager
{
    private $options;
    private $defaultOptions;
    private $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    public function setOptions()
    {
        /** @var SettingInterface $setting */
        foreach ($this->settings as $setting) {
            $options = get_option($setting->getSlug());

            $this->defaultOptions[$setting->getSlug()] = [];
            $this->options[$setting->getSlug()] = $options;

            /** @var FieldInterface $field */
            foreach ($setting->getFields() as $field) {
                $this->defaultOptions[$setting->getSlug()][$field->getSlug()] = $field->getValue();

                if (!empty($options[$field->getSlug()])) {
                    $field->setValue($options[$field->getSlug()]);
                }
            }
        }

        $this->options = array_merge(
            $this->defaultOptions, $this->options
        );
    }

    public function getOptions($group, $onlyDefault = false)
    {
        if ($onlyDefault) {
            return $this->defaultOptions[$group];
        }

        return $this->options[$group];
    }
}