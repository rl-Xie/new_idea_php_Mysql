<?php
tpl('api/Api');

class User extends Api
{
    public $table = 'user';

    public $rule = [
        'username' => 'max_length:24|min_length:2|unique:username',
        'password' => 'max_length:24|min_length:6',
        //'price' => 'numeric|positive',
        //'stock' => 'integer|positive',
    ];

    public function signup($rows, &$msg = null)
    {
        //判断是否有用户名和密码
        if (!($username = @$rows['username']) || !($password = @$rows['password'])) {
            $msg = 'invalid_username&&password';
            return false;
        }
        return $this->add($rows, $msg);
    }

    public function login($rows, &$msg)
    {
        if (!($username = @$rows['username']) || !($password = @$rows['password'])) {
            $msg = 'invalid_username&&password';
            return false;
        }
        $user = $this->where('username', $username)
            ->where('password', self::password_encryption($rows['password']))
            ->first();
        if (!$user) {
            $msg = 'username||password_no_exist';
            return false;
        }
        unset($user['password']);
        $_SESSION['user'] = $user;

        return true;
    }

    public static  function logout()
    {
        unset($_SESSION['user']);
        return true;
    }

    //登录加密
    public static function password_encryption($password)
    {
        return md5(md5($password) . 'wangye');
    }

    //注册加密
    public function before_encryption()
    {
        if (!$password = &$this->filled['password'])
            return;
        $password = self::password_encryption($password);
    }
}