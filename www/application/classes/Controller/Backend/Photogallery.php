<?php defined('SYSPATH') or die('No direct script access.');



class Controller_Backend_Photogallery extends Controller_Backend {

    protected $page_id = 5;




    public function  before()
    {
        parent::before();

    }


    public function action_index()
    {
        $this->template->page_title = 'Адмінка';
    }

    public function action_add() {

        $this->template->page_title = 'Додавання фото';

        $parent_id = $this->request->param('production');
        $sub_id = $this->request->param('sub');

        $languages = Model::factory('Main')->get_languages();

        $item_add = ORM::factory('Subpage', $sub_id);


        if (isset($_POST['submit'])) {

            $post = Validation::factory($_POST);
            $post->rule('text', 'not_empty')
                  ->labels(array('text' => 'Текст'));

            if($post->check()) {



                $from_form = Arr::extract($_POST, array('language', 'text', 'image','image_href'));

                /*$parent_id = ORM::factory('subpage')->where('parent_id', '=', 0)
                                                    ->and_where('page_id', '=', 5)
                                                    ->and_where('language_id', '=', $from_form['language'])
                                                    ->find();*/

                $subpage_id = ORM::factory('Subpage')->add_text($this->page_id, $from_form['language'], $isImage = 1, $from_form['text'],
                    $parent_id, $isInfo = 0);

                if(isset($from_form['image_href']))
                    ORM::factory('Image')->insert_image($subpage_id, $from_form['image_href']);

                if (!empty($_FILES['image']['name'][0]))
                {
//                    foreach ($_FILES['image']['tmp_name'] as $image)
//                    {
                        $image = $_FILES['image']['tmp_name'];
                        $filename = $this->_upload_img($image);

                        // Запись в БД
                        $im_db = ORM::factory('Image');
                        $im_db->subpage_id = $subpage_id;
                        $im_db->image_href = $filename;
                        $im_db->save();
//                    }


                }


                if (!isset($_SESSION['image_href']))
                    $_SESSION['image_href'] = $filename;

                if (!isset($_SESSION['counter']))
                    $_SESSION['counter'] = 0;

                $_SESSION['counter']++;

                if ($_SESSION['counter'] < 3) {
                    $this->redirect('admin/photogallery/add/' . $parent_id . '/' . 'add' . '/' . $subpage_id);
                } else {
                    $_SESSION['counter'] = 0;
                    $_SESSION['image_href'] = null;
                    $this->redirect('admin/photogallery/view/');
                }
            }

            $errors = $post->errors('validation');
        }


        $content = View::factory('backend/photogallery/v_photogallery_add', array('languages' => $languages,
            'parent_id' => $parent_id,
            'item' => $item_add))
                                        ->bind('errors', $errors)
                                        ->bind('post', $post)
                                        ->bind('image_href', $_SESSION['image_href']);


        // Вывод в шаблон
        $this->template->content = $content;
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
                ORM::factory('Subpage')->edit_text($id, $this->page_id, $this->lang_id, $isImage = 1, $from_form['text'],
                    $subpage->parent_id, $isInfo = 0);

                $this->redirect('admin/photogallery/view/' . $this->lang);
            }

            $errors = $post->errors('validation');

        }



        $content = View::factory('/backend/photogallery/v_photogallery_edit', array('text' => $subpage->texts->text,
                                                                            'image_href' => $subpage->images->image_href,
                                                                            'lang' => $this->lang,
                                                                            'id' => $id))
                                                        ->bind('errors', $errors)
                                                        ->bind('post', $post);



        // Вывод в шаблон
        $this->template->content = $content;
    }

    public function action_view()
    {
        $this->template->page_title = 'Фотогалерея';

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
                ORM::factory('Main')->name_main(5, $this->lang_id, $from_form['text']);
                $this->redirect('admin/photogallery/view/');
            }

            $errors = $post->errors('validation');
        }

        $items = ORM::factory('Subpage')->get_items($id_parents_name, $this->lang_id, $this->page_id);

        $content = View::factory('/backend/photogallery/v_photogallery_view', array('parents_name' => $parents_name,
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

        ORM::factory('Subpage')->delete_subpage_image($id);

        $this->redirect('admin/photogallery/view/'.$this->lang);

    }

    public function _upload_img($file, $ext = NULL, $directory = NULL){

        if($directory == NULL)
        {
            $directory = 'media/uploads';
        }

        if($ext== NULL)
        {
            $ext= 'jpg';
        }

        // Генерируем случайное название
        $symbols = '0123456789abcdefghijklmnopqrstuvwxyz';

        $filename = '';
        for($i = 0; $i < 10; $i++)
        {
            $filename .= rand(1, strlen($symbols));
        }

        // Изменение размера и загрузка изображения
        $im = Image::factory($file);
	
	if($im->width < $im->height)
        {
            $im->resize(150, 113, Image::NONE);
        } else $im->resize(150);
                
        $im->save("$directory/small_$filename.$ext");

        $im = Image::factory($file);
        $im->save("$directory/$filename.$ext");

        return "$filename.$ext";
    }
} // End Welcome
