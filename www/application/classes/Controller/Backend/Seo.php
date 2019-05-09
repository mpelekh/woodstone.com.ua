<?php defined('SYSPATH') or die('No direct script access.');



class Controller_Backend_Seo extends Controller_Backend {

    public function  before()
    {
        parent::before();

    }

    public function action_view()
    {
        $this->template->page_title = 'CEO';

        $page_id =  (int)$this->request->param('id');

        if($page_id == 0 || $page_id > 11 )
            $page_id = 1;

        // Menu
        $menu = Model::factory('Menu')->get_menu($page_id);

        // Langs
        $langs = ORM::factory('Language')
                ->find_all()
                ->as_array();

        $seo = ORM::factory('Seo')->where('page_id','=',$page_id)->find();
        $seo_arr = $seo->as_array();

        // Form Send
        if (isset($_POST['submit'])) {

            // Извлекаем данные из POST запроса
            $post = $this->request->post();

            // Данные для записи в таблицу
            $seo_data = array();

            foreach($langs as $lang)
            {
                $seo_data['meta_title_'.strtolower($lang->language)] = htmlspecialchars($post['meta-title-'.strtolower($lang->language)]);
                $seo_data['meta_description_'.strtolower($lang->language)] = htmlspecialchars($post['meta-description-'.strtolower($lang->language)]);
            }

            // Save
            $seo->values($seo_data)->save();

            HTTP::redirect(URL::site('admin/seo/view/'.$page_id));

        }

        // Вывод в шаблон
        $content = View::factory('backend/seo/v_seo_view');
        $content->bind('menu', $menu);
        $content->bind('langs', $langs);
        $content->bind('page_id',$page_id);
        $content->bind('seo',$seo_arr);

        $this->template->content = $content;
    }

}