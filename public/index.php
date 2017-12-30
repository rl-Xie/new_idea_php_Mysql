<?php
require_once('../helper/helper.php');
tpl('api/user');
tpl('api/product');
tpl('api/cat');
tpl('api/order');
tpl('api/cart');

init();
function init()
{
    session_start();
    routing_uri();
}

//路由
function routing_uri()
{
    $uri = $_SERVER["REQUEST_URI"];
    $uri = explode('?', $uri)[0];
    $arr = explode('/', trim($uri, '/'));
    $params = array_merge($_GET, $_POST);

    switch ($arr[0]) {
        case 'api':
            $method = ucfirst($arr[1]);
            $action = $arr[2];
            $msg = [];
            //判断权限
            if (!has_permission_to($arr[1], $arr[2])) {
                json_die(e('permission_denied'));
            }
            $klass = new $method();
            $r = $klass->$action($params, $msg);
            if ($r === false)
                json_die(e($msg));

            json_die(s($r));
            break;
        case 'admin':
            tpl('view/admin/' . $arr[1]);
            die();
            break;
        case '':
            tpl('view/public/home');
            break;
        case 'login':
            tpl('view/public/login');
            break;
        case 'signup':
            tpl('view/public/signup');
            break;
        case 'logout':
            User::logout();
            redirect('/login');
            break;
        default:
            break;
    }
}

function has_permission_to($model, $action)
{
    $public = [
        'user'    => ['signup', 'login', 'logout'],
        'product' => ['read', 'read_item', 'read_number'],
        'cat'     => ['read', 'read_number'],
    ];
    $private = [
        'product' => [
            'add'    => ['admin'],
            'change' => ['admin'],
            'remove' => ['admin'],
        ],
        'cat'     => [
            'add'    => ['admin'],
            'change' => ['admin'],
            'remove' => ['admin'],
        ],
        'order'   => [
            'checkout' => ['user', 'admin'],
        ],
        'cart'    => [
            'add_or_update' => ['user', 'admin'],
            'get_data_s'    => ['user', 'admin'],
            'delete_all_or_item' => ['user','admin'],
        ],
    ];
    if (!key_exists($model, $public) && !key_exists($model, $private)) {
        return false;
    }
    $public_model = @$public[ $model ];
    if ($public_model && in_array($action, $public_model)) {
        return true;
    }
    $action_arr = $private[ $model ];
    if (!$action_arr || !key_exists($action, $action_arr)) {
        return false;
    }
    $permission_arr = @$action_arr[ $action ];
    //用户权限
    $user_permission = @$_SESSION['user']['permission'];
    if (!in_array($user_permission, $permission_arr)) {
        return false;
    }

    return true;
}