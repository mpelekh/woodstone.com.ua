<?php defined('SYSPATH') or die('No direct script access.');



class Controller_Backend_Products extends Controller_Backend {

    protected $page_id = 3;




    public function  before()
    {
        parent::before();

    }


    public function action_index()
    {
        $this->template->page_title = 'Адмінка';
    }

    public function action_add() {

        //session_start();

        $this->template->page_title = 'Додавання';

        $parent_id = $this->request->param('production');
        $sub_id = $this->request->param('sub');

        $languages = Model::factory('Main')->get_languages();
        $measures = ORM::factory('Measure')->get_measures();
        $item_add = ORM::factory('Subpage', $sub_id);


        if (isset($_POST['submit'])) {

            $post = Validation::factory($_POST);
            $post->rule('text', 'not_empty')
                 ->rule('price', 'not_empty')
                 ->rule('price', 'numeric')
                 ->labels(array('text' => 'Текст',
                                'price' => 'Ціна'));

            if($post->check()) {

                $from_form = Arr::extract($_POST, array('language', 'text', 'measure', 'price'));
                $subpage_id = ORM::factory('Subpage')->add_text($this->page_id, $from_form['language'], $isImage = 0, $from_form['text'],
                    $parent_id, $isInfo = 1, $from_form['measure'], $from_form['price']);

                if (!isset($_SESSION['counter']))
                    $_SESSION['counter'] = 0;

                $_SESSION['counter']++;

                if ($_SESSION['counter'] < 3) {
                    $this->redirect('admin/products/add/' . $parent_id . '/' . 'add' . '/' . $subpage_id);
                } else {
                    $_SESSION['counter'] = 0;
                    $this->redirect('admin/products/view/');
                }
            }

            $errors = $post->errors('validation');
        }


        $content = View::factory('backend/products/v_products_add', array('languages' => $languages,
            'measures' => $measures,
            'parent_id' => $parent_id,
            'item' => $item_add))
                                        ->bind('errors', $errors)
                                        ->bind('post', $post);

        // Вывод в шаблон
        $this->template->content = $content;
    }

    public function action_edit()
    {
        $this->template->page_title = 'Редагування';

        $id = $this->request->param('production');


        $info = ORM::factory('Info', array('subpage_id' => $id));
        $measures = ORM::factory('Measure')->get_measures();

        $subpage = ORM::factory('Subpage', $id);

        if (isset($_POST['submit'])) {
            $post = Validation::factory($_POST);
            $post->rule('text', 'not_empty')
                ->rule('price', 'not_empty')
                ->rule('price', 'numeric')
                ->labels(array('text' => 'Текст',
                    'price' => 'Ціна'));

            if($post->check()) {

                $from_form = Arr::extract($_POST, array('text', 'measure', 'price', 'is_from'));
                ORM::factory('Subpage')->edit_text($id, $this->page_id, $this->lang_id, $isImage = 0, $from_form['text'],
                    $subpage->parent_id, $isInfo = 1, $from_form['measure'], $from_form['price'], $from_form['is_from']);

                $this->redirect('admin/products/view/' . $this->lang);
            }

            $errors = $post->errors('validation');

        }



        $content = View::factory('/backend/products/v_products_edit', array('text' => $subpage->texts->text,
                                                                            'lang' => $this->lang,
                                                                            'measure' => $info->measure_id,
                                                                            'measures' => $measures,
                                                                            'price' => $info->price,
                                                                            'info' => $info,
                                                                            'id' => $id))
                                                        ->bind('errors', $errors)
                                                        ->bind('post', $post);



        // Вывод в шаблон
        $this->template->content = $content;
    }

    public function action_view()
    {
        $this->template->page_title = 'Продукція';

        $languages = Model::factory('Main')->get_languages();

        $parents_name = ORM::factory('Subpage')->get_parents_name($this->page_id, $this->lang_id);

        foreach($parents_name as $p){
            $id_parents_name[] = $p->id;

        }

        if (isset($_POST['submit'])) {
            $post = Validation::factory($_POST);
            $post->rule('text', 'not_empty');

            if($post->check()) {
                $from_form = Arr::extract($_POST, array('text'));
                ORM::factory('Main')->name_main(3, $this->lang_id, $from_form['text']);
                $this->redirect('admin/products/view/'.$this->lang);
            }

            $errors = $post->errors('validation');
        }

        $items = ORM::factory('Subpage')->get_items($id_parents_name, $this->lang_id, $this->page_id);


        $content = View::factory('/backend/products/v_products_view', array('parents_name' => $parents_name,
            'items' => $items,
            'lang' => $this->lang,
            'languages' => $languages,
            'lang_id' => $this->lang_id))
            ->bind('errors', $errors);



        // Вывод в шаблон
        $this->template->content = $content;
    }

    public function action_delete()
    {
        $this->template->page_title = 'Видалення';

        $id = $this->request->param('production');

        ORM::factory('Subpage')->delete_subpage($id);

        $this->redirect('admin/products/view/'.$this->lang);

    }

} // End Welcome
