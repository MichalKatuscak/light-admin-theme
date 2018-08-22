<?php

namespace LightAdminTheme\Field;

abstract class Field implements FieldInterface
{
    private $value;

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}