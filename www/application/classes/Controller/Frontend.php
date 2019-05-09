<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend extends Controller_Base {

    public $template = 'frontend/v_base_frontend';        // Базовый шаблон



    public function  before() {
        parent::before();

        if(isset($_SERVER['REQUEST_URI']) && preg_match('/main/',$_SERVER["REQUEST_URI"])) {
           $this->redirect($this->lang,301);
        }

        $formsend = View::factory('widgets/w_formsend', array('lang' => $this->lang,
                                'controller' => $this->request->controller(),
                                'text_question' => __('Ваше запитання')));


        $static = ORM::factory('Subpage')->where('page_id', '=', 8)
                                        ->and_where('parent_id', '!=', 0)
                                        ->and_where('language_id', '=', $this->lang_id)
                                        ->find_all();

        //Для вывода подпродукции
        $product_id = ($this->request->param('id')) ? $this->request->param('id') : '';


        //Проверка на существование в базе
        if(ORM::factory('Subpage')->where('page_id', '=', 3)->and_where('parent_id', '=', 0)->and_where('id', '=', $product_id)->find() != $product_id)
        {
            $product_id ='';
        }


        $lang = $this->request->param('lang');
        $this->template->lang = $lang;
        $this->template->formsend = $formsend;
        $this->template->static = $static;
        $this->template->product_id = $product_id;

        // SEO
        if($lang == '')
            $lang = 'ua';

        $seo_controller = strtolower(Request::current()->controller());

        if($seo_controller == 'products') {
            $seo_controller .= $product_id;
        }

        $seo = ORM::factory('Seo')
            ->where('name_en','=',$seo_controller)
            ->find()
            ->as_array();

        $this->template->page_title = $seo['meta_title_'.$lang];
        $this->template->site_description = $seo['meta_description_'.$lang];

        // Виджеты
        //$topmenu = Widget::load('topmenu', array('id' => $this->lang));
        // Вывод в шаблон
        //$this->template->styles = array('media/css/style.css', 'media/css/bootstrap.min.css', 'media/css/bootstrap-responsive.min.css',);
        //$this->template->scripts = array('media/js/bootstrap.min.js',);
        //$this->template->fotolinks = null;
        //$this->template->topmenu = $topmenu;
    }

}