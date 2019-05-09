<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_About extends Controller_Frontend {



    public function action_index()
    {
        $page_id = 2;
        $text = ORM::factory('Subpage')->get_text($page_id, $this->lang_id);
        $content = View::factory('frontend/about/v_about_f', array('text' => $text));

        // Виджеты
        //$fotolinks = Widget::load('fotolinks');

//        $this->template->page_title = __('Про нас');
        $this->template->content = $content;
        //$this->template->fotolinks = $fotolinks;
    }

} // End Welcome
