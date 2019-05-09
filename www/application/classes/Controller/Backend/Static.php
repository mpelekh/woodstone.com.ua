<?php defined('SYSPATH') or die('No direct script access.');



class Controller_Backend_Static extends Controller_Backend {

    protected $page_id = 8;




    public function  before()
    {
        parent::before();

    }


    public function action_index()
    {
        $this->template->page_title = 'Адмінка';
    }



    public function action_edit()
    {
        $this->template->page_title = 'Редагування';

        $id = $this->request->param('production');

        $subpage = ORM::factory('Subpage', $id);

        if (isset($_POST['submit'])) {
            $post = Validation::factory($_POST);
            $post->rule('text', 'not_empty')

                ->labels(array('text' => 'Текст'));

            if($post->check()) {

                $from_form = Arr::extract($_POST, array('text'));
                ORM::factory('Subpage')->edit_text($id, $this->page_id, $this->lang_id, $isImage = 0, $from_form['text'],
                    $subpage->parent_id);

                $this->redirect('admin/static/view/' . $this->lang);
            }

            $errors = $post->errors('validation');

        }



        $content = View::factory('/backend/static/v_static_edit', array('text' => $subpage->texts->text,
            'lang' => $this->lang,
            'id' => $id))
            ->bind('errors', $errors)
            ->bind('post', $post);



        // Вывод в шаблон
        $this->template->content = $content;
    }

    public function action_view()
    {
        $this->template->page_title = 'Статика';

        $languages = Model::factory('Main')->get_languages();

        $parents_name = ORM::factory('Subpage')->get_parents_name($this->page_id, $this->lang_id);

        foreach($parents_name as $p){
            $id_parents_name[] = $p->id;

        }


        $items = ORM::factory('Subpage')->get_items($id_parents_name, $this->lang_id, $this->page_id);


        $content = View::factory('/backend/static/v_static_view', array('parents_name' => $parents_name,
            'items' => $items,
            'lang' => $this->lang,
            'languages' => $languages,
            'lang_id' => $this->lang_id))
            ->bind('errors', $errors);



        // Вывод в шаблон
        $this->template->content = $content;
    }


} // End Welcome
