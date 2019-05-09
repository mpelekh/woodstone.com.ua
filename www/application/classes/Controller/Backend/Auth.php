<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Авторизация
 */
class Controller_Backend_Auth extends Controller_Auth {

    public function before()
    {
        parent::before();
    }


    public function action_index() {
        $this->action_login();
    }

    public function action_login() {

        if(Auth::instance()->logged_in('admin')) {
            $this->redirect('admin/main/edit');
        }

        if (isset($_POST['submit'])){
            $data = Arr::extract($_POST, array('username', 'password', 'remember'));
            $status = Auth::instance()->login($data['username'], $data['password'], (bool) $data['remember']);
           // echo $data['password'];
           // echo $data['username'];
           // echo (string)$data['remember'];
            if ($status){
                $this->redirect('admin/main/edit');
            }
            else {
                $errors = array(Kohana::message('auth/user', 'no_user'));
            }
        }
        
        $content = View::factory('backend/auth/v_auth_login')
                                    ->bind('errors', $errors)
                                    ->bind('data', $data);


        // Выводим в шаблон
        $this->template->page_title = 'Вход';
        $this->template->content = $content;
    }

 /*   public function action_register() {

        if (isset($_POST['submit'])){
            $data = Arr::extract($_POST, array('username', 'password', 'password_confirm', 'email'));
            $users = ORM::factory('User');

            try {
                $users->create_user($_POST, array(
                    'username',
                    'password',
                    'email',
                ));

                $role = ORM::factory('Role')->where('name', '=', 'login')->find();
                $users->add('roles', $role);
                $this->action_login();
                $this->redirect('admin/main/edit');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('auth');
            }
        }

        $content = View::factory('backend/auth/v_auth_register')
            ->bind('errors', $errors)
            ->bind('data', $data);

        // Выводим в шаблон
        $this->template->page_title = 'Регистрация';
        $this->template->content = $content;
    } */

    public function action_logout() {
        if(Auth::instance()->logout()) {
            $this->redirect();
        }
    }

}