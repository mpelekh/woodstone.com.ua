<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Products extends Controller_Frontend {



    public function action_index()
    {
        $page_id = 3;

        //Для вывода подпродукции
        $product_id = ($this->request->param('id')) ? $this->request->param('id') : '';

        $id_parents_name[] = null;

        //Проверка на существование в базе
        if(ORM::factory('Subpage')->where('page_id', '=', $page_id)->and_where('parent_id', '=', 0)->and_where('id', '=', $product_id)->find() != $product_id)
        {
            $product_id ='';
        }



        //Если есть $product_id то выводим только по нему
        if($product_id == '') {

            $parents_name = ORM::factory('Subpage')->get_parents_name($page_id);

            foreach ($parents_name as $p) {
                $id_parents_name[] = $p->id;
            }
        }
        else
        {
            $parents_name = ORM::factory('Subpage')->where('page_id', '=', $page_id)
                ->and_where('parent_id', '=', 0)
                ->and_where('id', '=', $product_id)
                ->find_all()
                ->as_array();

            $id_parents_name[] = $product_id;

        }

        $product_text_id = 0;
        $product_text = '';

        // Находим текст подпродукции
        if($product_id != '') {

            if($product_id == 7){
                if($this->lang == '')
                    $product_text_id = 538;
                else if($this->lang == 'ru')
                    $product_text_id = 537;
                else if($this->lang == 'en')
                    $product_text_id = 536;
            }
            else if($product_id == 8){
                if($this->lang == '')
                    $product_text_id = 541;
                else if($this->lang == 'ru')
                    $product_text_id = 540;
                else if($this->lang == 'en')
                    $product_text_id = 539;
            }
            else if($product_id == 502){
                if($this->lang == '')
                    $product_text_id = 544;
                else if($this->lang == 'ru')
                    $product_text_id = 543;
                else if($this->lang == 'en')
                    $product_text_id = 542;
            }
            else if($product_id == 503){
                if($this->lang == '')
                    $product_text_id = 547;
                else if($this->lang == 'ru')
                    $product_text_id = 546;
                else if($this->lang == 'en')
                    $product_text_id = 545;
            }

            $product_text = ORM::factory('Text')
                ->where('subpage_id', '=', $product_text_id)
                ->find()
                ->text;

        }

        $items = ORM::factory('Subpage')->get_items($id_parents_name, $this->lang_id, $page_id);


        $formsend = View::factory('widgets/w_formsend', array('lang' => $this->lang,
                                                                'controller' => $this->request->controller(),
                                                                'text_question' => __('Ваше замовлення')));

        $content = View::factory('frontend/products/v_products_f', array('items' => $items,
                                                                        'parents_name' => $parents_name,
                                                                            'formsend' => $formsend,
                                                                            'product_id' => $product_id,
                                                                            'lang' => $this->lang,
                                                                            'product_text' => $product_text));

//        $this->template->page_title = __('Продукція');
        $this->template->content = $content;
    }

} // End Welcome
