<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Базовый класс виджетов
 */
class Controller_Widgets extends Controller_Base {

    public function  before() {

        parent::before();

        if(Request::current()->is_initial())
        {
            $this->auto_render = FALSE;
        }
    }

}
