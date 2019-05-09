<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Main extends Controller_Frontend {

    public function  before() {
        parent::before();



    }


    public function action_index()
    {
        $page_id = 1;
        $text = ORM::factory('Subpage')->get_text($page_id, $this->lang_id);
        $items = ORM::factory('Subpage')->get_img($this->lang_id, 5);
        $content = View::factory('frontend/main/v_main_f', array('text' => $text,
                                                                'items' => $items,
								'lang' => $this->lang));
//        $this->template->page_title = __('Головна');
        $this->template->content = $content;

    }

} // End Welcome
