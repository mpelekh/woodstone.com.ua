<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Services extends Controller_Frontend {



    public function action_index()
    {
        $page_id = 4;

        $id_parents_name[] = null;

        $parents_name = ORM::factory('Subpage')->get_parents_name($page_id);

        foreach($parents_name as $p){
            $id_parents_name[] = $p->id;

        }

        $items = ORM::factory('subpage')->get_items($id_parents_name, $this->lang_id, $page_id);

        $formsend = View::factory('widgets/w_formsend', array('lang' => $this->lang,
            'controller' => $this->request->controller(),
            'text_question' => __('Ваше замовлення')));

        $content = View::factory('frontend/services/v_services_f', array('items' => $items,
                                                                        'parents_name' => $parents_name,
                                                                        'formsend' => $formsend));

//        $this->template->page_title = __('Послуги');
        $this->template->content = $content;
    }

} // End Welcome
