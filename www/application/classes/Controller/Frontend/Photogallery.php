<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Photogallery extends Controller_Frontend {

    public function action_index()
    {
        $page_id = 5;

        $parents_name = ORM::factory('Subpage')->get_parents_name($page_id);

        foreach($parents_name as $p){
            $id_parents_name[] = $p->id;
        }


        $items = ORM::factory('Subpage')->get_items($id_parents_name, $this->lang_id, $page_id);



        $content = View::factory('frontend/photogallery/v_photogallery_f', array('items' => $items,
                                                                                 'parents_name' => $parents_name));

//        $this->template->page_title = __('Фотогалерея');
        $this->template->content = $content;
    }

} // End Welcome
