<?php defined('SYSPATH') or die('No direct script access.');



class Controller_Frontend_Send extends Controller_Frontend {

    public function action_index()
    {
        if (isset($_POST['submit'])) {
            $post = Validation::factory($_POST);
            $post->rule('name', 'not_empty')
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

            $contr = Arr::extract($_POST, array('controller'));

            if($post->check()) {

                $config = Kohana::$config->load('email');
                Email::connect($config);

                $from_form = Arr::extract($_POST, array('name', 'tel', 'email', 'question', 'controller'));

                $to = 'tzovkarpaty@gmail.com';
                //$to = 'd.koval7@gmail.com';
                $from = 'karpaty1221@gmail.com';
                $subject = 'Запитання відвідувача сайту "Карпати"';

                $message = '<b>Iмя:</b> '.$from_form['name'].'<br><b>Телефон:</b> '.$from_form['tel'].
                    '<br><b>Email:</b> '.$from_form['email'].'<br><b>Запитання:</b> '.$from_form['question'];

                Email::send($to, $from, $subject, $message, $html = true);

                $this->redirect('/'.$this->lang.'/'.$from_form['controller']);
            }

            //var_dump('/'.$this->lang.'/'.$contr['controller']);

            //$errors = $post->errors('validation');

            $this->redirect('/'.$this->lang.'/'.$contr['controller']);

        }




    }


} // End Welcome
