<?php

namespace LightAdminTheme\Setting;

interface SettingInterface
{
    public function addSetting();
    public function addSection();
    public function getSlug();
    public function getName();
    public function getFields();
}