<?php

require_once (rtrim(FCPATH, '\\') . '/xcrud/xcrud.php');
if (!function_exists('xcrud_get_instance')) {

    function xcrud_get_instance($name = false) {
        return Xcrud::get_instance($name);
    }

}
