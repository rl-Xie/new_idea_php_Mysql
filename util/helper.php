<?php
//拿到文件的决定路径
function tpl($path)
{
    require_once(path($path));
}

function path($path, $type = 'php')
{
    return (__DIR__ . '/../' . $path . '.' . $type);
}
//读取文件内容  从文件中拿到配置
function config($key)
{
    if (!$config = @$GLOBALS['__config']) {

        $json = file_get_contents(path('.config', 'json'));
        $config = json_decode($json, true);
        $GLOBALS['__config'] = $config;
    }
    //获取这个文件的路径
    return @$config[ $key ];
}

function json($data)
{
    header('Content-Type: application/json');
    return json_encode($data);
}
