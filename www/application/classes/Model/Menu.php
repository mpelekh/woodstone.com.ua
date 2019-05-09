<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Menu extends Model {

    public function get_menu($current) {

        $menu = Kohana::$config->load('seo_menu');

        foreach($menu as $key => $value)
        {
            if( $value['id'] == $current ) {
                $menu[$key] = array_merge($menu[$key], array('active' => true));
            }
            else {
                $menu[$key] = array_merge($menu[$key], array('active' => false));
            }

            if(is_array($value['submenu']))
            {
                foreach($value['submenu'] as $subkey => $subvalue)
                {
                    if( $subvalue['id'] == $current ) {
                        $menu[$key]['submenu'][$subkey] = array_merge($menu[$key]['submenu'][$subkey],array('active' => true));
                    }
                    else {
                        $menu[$key]['submenu'][$subkey] = array_merge($menu[$key]['submenu'][$subkey], array('active' => false));
                    }
                }
            }
        }

        return $menu;

    }
}