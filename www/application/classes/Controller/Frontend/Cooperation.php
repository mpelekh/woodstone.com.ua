<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Cooperation extends Controller_Frontend {



    public function action_index()
    {
        $page_id = 7;

        $id_parents_name[] = null;

        $parents_name = ORM::factory('Subpage')->get_parents_name($page_id);

        foreach($parents_name as $p){
            $id_parents_name[] = $p->id;

        }

        $items = ORM::factory('Subpage')->get_items($id_parents_name, $this->lang_id, $page_id);



        $formsend = View::factory('widgets/w_formsend', array('lang' => $this->lang,
                                                                'controller' => $this->request->controller(),
                                                                'text_question' => __('Питання щодо партнерства')));

        $content = View::factory('frontend/cooperation/v_cooperation_f', array('items' => $items,
                                                                                'parents_name' => $parents_name,
                                                                                'formsend' => $formsend));

//        $this->template->page_title = __('Співпраця');
        $this->template->content = $content;
    }

} // End Welcome
