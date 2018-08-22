<?php

namespace LightAdminTheme\Setting;

use LightAdminTheme\Field\FieldInterface;
use LightAdminTheme\LightAdminTheme;
use LightAdminTheme\Option\OptionInterface;

abstract class Setting implements SettingInterface
{
    protected $fields = [];

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function addSetting()
    {
        foreach ($this->fields as $field) {
            $this->addField($field);
        }
    }

    protected function addField(FieldInterface $field)
    {
        $slug = $field->getSlug();
        $title = $field->getName();
        $optionClass = $field->getType();

        $option = new $optionClass;

        if (! $option instanceof OptionInterface) {
            throw new \InvalidArgumentException("Option class must implement 'OptionInterface'");
        }

        add_settings_field(
            $slug,
            __($title, LightAdminTheme::SLUG),
            [$option, "render"],
            LightAdminTheme::SLUG,
            $this->getSlug(),
            [
                "group" => $this->getSlug(),
                "option" => $slug,
                "value" => $field->getValue(),
                "fields" => $this->getFields()
            ]
        );
    }

    public function addSection()
    {
        add_settings_section(
            $this->getSlug(),
            __($this->getName(), LightAdminTheme::SLUG),
            array($this, "addSetting"),
            LightAdminTheme::SLUG
        );
    }
}