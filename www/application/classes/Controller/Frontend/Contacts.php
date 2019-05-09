<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Contacts extends Controller_Frontend {

    public function action_index()
    {

        $page_id = 6;
        $text = ORM::factory('Subpage')->get_text($page_id, $this->lang_id);


        $content = View::factory('frontend/contacts/v_contacts_f', array('lang' => $this->lang,
                                                                        'text' => $text))
                                                                    ->bind('errors', $errors);

        if (isset($_POST['submit'])) {
            $post = Validation::factory($_POST);
            $post->rule('name', 'not_empty')
                ->rule('town', 'not_empty')
                ->rule('tel', 'not_empty')
                ->rule('tel', 'numeric')
                ->rule('email', 'not_empty')
                ->rule('email', 'email')
                ->rule('question', 'not_empty')


                ->rule('sdf', 'not_empty')
                ->rule('sdf', 'Security::check')
                ->rule('captcha', 'not_empty')
                ->rule('captcha', 'Captcha::valid')


                ->labels(array('name' => __("Ваше Ім'я"),
                    'town' =>__("Місто"),
                    'tel' => "Телефон",
                    'email' => "Email",
                    'question' => __("Запитання")));

            if($post->check()) {

                $config = Kohana::$config->load('email');
                Email::connect($config);

                $from_form = Arr::extract($_POST, array('name', 'town', 'tel', 'email', 'question'));

                $to = 'tzovkarpaty@gmail.com';
                //$to = 'd.koval7@gmail.com';
                $from = 'karpaty1221@gmail.com';
                $subject = 'Запитання відвідувача сайту "Карпати"';

                $message = '<b>Iмя:</b> '.$from_form['name'].'<br><b>Мiсто:</b> '.$from_form['town'].'<br><b>Телефон:</b> '.$from_form['tel'].
                    '<br><b>Email:</b> '.$from_form['email'].'<br><b>Запитання:</b> '.$from_form['question'];

                Email::send($to, $from, $subject, $message, $html = true);
            }

            $errors = $post->errors('validation');

        }

//        $this->template->page_title = __('Контакти');
        $this->template->content = $content;
    }


} // End Welcome
