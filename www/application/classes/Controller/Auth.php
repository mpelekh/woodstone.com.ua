<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Base {

    public $template = 'backend/v_base_backend';        // Базовый шаблон



    public function  before() {
        parent::before();

        // Вывод в шаблон
        //$this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->adminmenu = null;
        $this->template->content = null;
    }

}