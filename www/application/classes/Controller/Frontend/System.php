<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_System extends Controller_Frontend {


    public function before()
    {
        parent::before();

    }

    public function action_404()
    {
        $this->template->page_title = __('Помилка');
        $this->template->content = View::factory('frontend/errors/404')
                                            ->set('lang', $this->lang);
    }

}