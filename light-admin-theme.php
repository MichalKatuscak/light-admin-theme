<?php
/*
Plugin Name: Light Admin Theme
Plugin URI: http://wordpress.org/plugins/light-admin-theme/
Description: This plugin will simplify and manage your administration.
Author: Michal Katuščák
Version: 0.3
Author URI: https://katuscak.cz/
*/

spl_autoload_register(function($class){
    if (strpos($class, "LightAdminTheme\\") === 0) {
        $class = ltrim($class, "LightAdminTheme");
        $class = str_replace("\\", "/", $class);
        include_once __DIR__ . '/src/' . $class . '.php';
    }
});

$lat = new \LightAdminTheme\LightAdminTheme();

