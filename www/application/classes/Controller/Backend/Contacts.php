<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Contacts extends Controller_Backend {

    public function  before() {
        parent::before();

    }


    public function action_index()
    {
        $this->template->page_title = 'Адмінка';
    }


    public function action_edit()
    {
        $this->template->page_title = 'Редагування';

        //$languages = Model::factory('main')->get_languages();
        //$content = View::factory('/backend/main/v_main_edit', array('languages' => $languages));
        //$this->template->content = $content;

        $languages = Model::factory('Main')->get_languages();

        $page_id = 6;

        $i = DB::select('id')
            ->from('subpage')
            ->where('page_id', '=', $page_id)
            ->and_where('language_id', '=', $this->lang_id)
            ->execute();

        $id = $i[0]['id'];

        //$languages = Model::factory('main')->get_languages();
        //$images = Model::factory('subpage')->get_images($id);
        $text = ORM::factory('Subpage')->get_text($page_id, $this->lang_id);


        if (isset($_POST['submit'])) {
            $post = Validation::factory($_POST);
            $post->rule('text', 'not_empty')
                ->labels(array('text' => 'Текст'));

            if($post->check()) {
                $from_form = Arr::extract($_POST, array('text'));
                Model::factory('Main')->edit_main($id, $page_id, $this->lang_id, $from_form['text']);
                $this->redirect('admin/contacts/edit/' . $this->lang);
            }

            $errors = $post->errors('validation');
        }

        $content = View::factory('/backend/contacts/v_contacts_edit', array('text' => $text,
                                                                    'lang' => $this->lang,
                                                                    'languages' => $languages,
                                                                    'lang_id' => $this->lang_id))
                                                                    ->bind('errors', $errors);

        // Вывод в шаблон
        $this->template->content = $content;
    }

} // End Welcome
