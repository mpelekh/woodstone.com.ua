<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Виджет "Верхнее меню"
 */
class Controller_Widgets_Topmenu extends Controller_Widgets {

    public $template = 'widgets/w_topmenu';

    public function before()
    {
        parent::before();

        $lang = $this->request->param('id');
        $this->template->lang = $lang;
    }

    public function action_index()
    {

    }

}