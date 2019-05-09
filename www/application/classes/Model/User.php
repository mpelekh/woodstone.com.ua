<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Auth_User {

  public function labels()
    {
        return array(
            'username' => 'Логин',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'password_confirm' => 'Повторить пароль',
        );
    }

    public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('min_length', array(':value', 4)),
				array('max_length', array(':value', 32)),
				array('regex', array(':value', '/^[-\pL\pN_.]++$/uD')),
				array(array($this, 'username_available'), array(':validation', ':field')),
			),
			'password' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('min_length', array(':value', 4)),
				array('max_length', array(':value', 127)),
				array('email'),
				array(array($this, 'email_available'), array(':validation', ':field')),
			),
		);
	}

    /** Does the reverse of unique_key_exists() by triggering error if username exists.
     * Validation callback.
     *
     * @param   Validation  Validation object
     * @param   string      Field name
     * @return  void
     */
    public function username_available(Validation $validation, $field)
    {
        if ($this->unique_key_exists($validation[$field], 'username'))
        {
            $validation->error($field, 'username_available', array($validation[$field]));
        }
    }

    /** Does the reverse of unique_key_exists() by triggering error if email exists.
     * Validation callback.
     *
     * @param   Validation  Validation object
     * @param   string      Field name
     * @return  void
     */
    public function email_available(Validation $validation, $field)
    {
        if ($this->unique_key_exists($validation[$field], 'email'))
        {
            $validation->error($field, 'email_available', array($validation[$field]));
        }
    }
} 
