<?php
tpl('api/Api');

class Cat extends Api
{
    public $table = 'cat';
    public $rule = [
        'title' => 'max_length:24|min_length:2|unique:title',
    ];
}