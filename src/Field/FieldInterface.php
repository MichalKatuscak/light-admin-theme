<?php

namespace LightAdminTheme\Field;

interface FieldInterface
{
    public function getName();
    public function getSlug();
    public function prepareAction();
    public function getWhere();
    public function getType();
    public function getValue();
    public function setValue($value);
}