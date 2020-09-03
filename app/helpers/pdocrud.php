<?php
require_once (app_path(). '/script/pdocrud.php');
if (!function_exists('new_PDOCrud')){
    function new_PDOCrud($multi = false, $template = "", $skin = "", $settings = array()){
        return new PDOCrud($multi, $template, $skin, $settings);
    }
}