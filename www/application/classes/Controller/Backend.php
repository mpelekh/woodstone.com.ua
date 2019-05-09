<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend extends Controller_Base {

    public $template = 'backend/v_base_backend';        // Базовый шаблон
    public $lang;
    public $lang_id;



    public function  before() {
        parent::before();
        if (!$this->auth->logged_in('admin')) {
            $this->redirect('login');
        }

        //Встановлення мови відповідно до <id> - ua | ru | en
        $this->lang = $this->request->param('id');

        if ($this->lang == 'ru')
            $this->lang_id = 2;
        else
            if ($this->lang == 'en')
                $this->lang_id = 3;
            else $this->lang_id = 1;

        // Виджеты
        $adminmenu = Widget::load('adminmenu');

        // Вывод в шаблон
        $this->template->adminmenu = $adminmenu;
        $this->template->content = null;
    }

}