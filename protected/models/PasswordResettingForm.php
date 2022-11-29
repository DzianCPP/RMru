<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PasswordResettingForm extends CFormModel {
    public $username;
    public $password;
    public $new_username;
    public $new_password;
    public $repeat_password;

   // public $verifyCode;

    public $user;

     public function __construct(){
         parent::__construct();
         $this->user = User::model()->findByPk(1);
     }
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
           array('username, password, new_username, new_password, repeat_password', 'required', 'message'=>'Поле не может быть пустым'),
           array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'message'=>'Корректно дважды введите новый пароль'),
           array('username', 'current_username'),
     //       array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements())
        );
    }

       public function current_username(){
           //$success = true;
           if($this->user->login != $this->username || $this->user->password != $this->password){
                $this->addError('username', 'Такого пользователя не существует!');
               $this->addError('password', 'Такого пользователя не существует');
                   return false;
               //$success = false;
           }
           return true;
          /* if($this->user->password != $this->password){
               $this->addError('password', 'Такого пользователя не существует')
           }*/


       }
    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => 'Текущий логин',
            'password' => 'Текущий пароль',
            'new_username' => 'Новый логин',
            'new_password' => 'Новый пароль',
            'repeat_password' => 'Повторите новый пароль',

        );
    }

   /* public function validateUsername() {
        if (!User::model()->countByAttributes(array('username' => $this->username))) {
            $this->addError('username', 'There is no such a user');
        }
    }*/

    public function resetPassword() {



        $this->user->password = $this->new_password;
        $this->user->login = $this->new_username;
        if ($this->user->save()) {
            return true;
        }

        return false;
    }
}
