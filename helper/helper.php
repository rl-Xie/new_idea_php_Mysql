<?php
function e($msg, $code = 403)
{
    if ($msg == 'db_internal_error')
        $code = 500;

    http_response_code($code);

    return ['success' => false, 'msg' => $msg];
}

function s($data = null, $code = 200)
{
    http_response_code($code);
    return ['success' => true, 'data' => $data];
}

function json_die($data)
{
    echo json($data);
    die();
}

function tpl($path)
{
    require_once(path($path));
}

function path($path, $type = 'php')
{
    return (__DIR__ . '/../' . $path . ($type ? '.' . $type : ''));
}

function config($key)
{
    if (!$config = @$GLOBALS['__config']) {
        //把文件读成字符串
        $json = file_get_contents(path('.config', 'json'));
        $config = json_decode($json, true);
        $GLOBALS['__config'] = $config;
    }

    return @$config[ $key ];
}

function json($data)
{
    header('Content-Type: application/json');
    return json_encode($data);
}

//判断是否登录
function logged_in()
{
    return (bool)@$_SESSION['user']['id'];
}

//跳转
function redirect($url)
{
    header("Location: $url");
}

//获取登录的用户名
function his($username)
{
    if (!logged_in()) {
        return null;
    }
    return @$_SESSION['user'][ $username ];
}

function move_uploded($key, &$data = null)
{
    $file_type = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
    ];
    $file = @$_FILES[ $key ];
    if (!$tmp = $file['tmp_name'])
        return false;

    $old_name = $file['name'];
    $file_name = uniqid() . '.' . rand(100, 999);
    $mime = $file['type'];
    $ext = $file_type[ $mime ];

    $dest = path('public/upload', '') . "/$file_name.$ext";
    if ($r = move_uploaded_file($tmp, $dest))
        $data = [
            'name'     => $file_name,
            'ext'      => $ext,
            'fullname' => "$file_name.$ext",
            'mime'     => $mime,
            'size'     => $file['size'],
            'old_name' => $old_name,
        ];

    return $r;
}