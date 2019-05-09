<?php defined('SYSPATH') or die('No direct access allowed.');


if($_SERVER['HTTP_HOST'] == 'karp_web')
{
    return array
    (
        'default' => array
        (
            'type'       => 'MySQL',
            'connection' => array(
                'hostname'   => 'localhost',
                'database'   => 'karpaty',
                'username'   => 'root',
                'password'   => '',
                'persistent' => FALSE,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
        ),

    );
}

else {

    return array
    (
        'default' => array
        (
            'type' => 'MySQL',
            'connection' => array(
                'hostname' => 'citymoto.mysql.ukraine.com.ua',
                'database' => 'citymoto_c30karp',
                'username' => 'citymoto_c30karp',
                'password' => 'adsfHLH123*',
                'persistent' => FALSE,
            ),
            'table_prefix' => '',
            'charset' => 'utf8',
            'caching' => FALSE,
            'profiling' => TRUE,
        ),
    );
}