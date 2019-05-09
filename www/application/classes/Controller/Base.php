<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Общий базовый класс
 */
class Controller_Base extends Controller_Template
{

    public $lang_id = NULL;
    public $lang = NULL;
    protected $user;
    protected $auth;

    public function before()
    {
        parent::before();

        $this->auth = Auth::instance();
        $this->user = $this->auth->get_user();

        //Встановлення мови відповідно до <lang> - ua | ru | en
        $this->lang = $this->request->param('lang');

        if ($this->lang == 'ru')
            $this->lang_id = 2;
        else
            if ($this->lang == 'en')
                $this->lang_id = 3;
            else {
                $this->lang == 'ua';
                $this->lang_id = 1;
            }


        Cookie::set('lang', strip_tags($this->lang));
        I18n::lang(strip_tags($this->lang));

        $settings = Kohana::$config->load('settings');

        // Вывод в шаблон
        $this->template->site_name = $settings->site_name;
        $this->template->site_description = $settings->site_description;
        $this->template->site_keywords = $settings->site_keywords;
        $this->template->page_title = null;
        //$this->template->lang = $this->lang;


        // Подключаем стили и скрипты
        $this->template->styles = array(
            'jquery.fancybox.css',
            'jquery.fancybox-buttons.css',
//            'ace.min.css',
            'ace-responsive.min.css',
            'ace-skins.min.css',
            'style.css',// 'style_old.css',
            'bootstrap.min.css',
            'bootstrap-responsive.min.css',
            'bootstrap-theme.min.css',
            'accordionImageMenu.css',
            'admin.css',
            'seo-menu.css'
            );

        $this->template->scripts = array(
            'jquery.min.js',
            'jquery.easing.min.js',
            'main.js',
            'jquery.mousewheel-3.0.6.pack.js',
            'jquery.fancybox.pack.js',
            'jquery.fancybox-buttons.js',
            'bootstrap.min.js',
            'jquery.accordionImageMenu.js',
            'jquery.placeholder.js',
            'upload.js',
            'jquery.MultiFile.pack.js',
            'respond.min.js',
            'ace-elements.min.js',
//            'ace.min.js'
        );

        // Подключаем блоки
        /* $this->template->block_left = null;
         $this->template->block_right = null;*/

        $this->template->header = null;
        $this->template->block_center = null;
        $this->template->footer = null;
        $this->template->content = null;

    }

}
