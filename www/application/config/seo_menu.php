<?php defined('SYSPATH') or die('No direct script access.');

return array(

        'Головна' => array(
            'id' => 1,
            'submenu' => false ),

        'Про нас' => array(
            'id' => 2,
            'submenu' => false ),

        'Продукція' => array(
            'id' => 3,
            'submenu' => array(

                'Мармурова крихта' => array(
                    'id' => 4 ),

                'Деревообробний цех' => array(
                    'id' => 5 ),

                'Цех готової продукції' => array(
                    'id' => 6 ),

                'Столярний цех' => array(
                    'id' => 7 )

            ) ),

        'Послуги' => array(
            'id' => 8,
            'submenu' => false ),

        'Фотогалерея' => array(
            'id' => 9,
            'submenu' => false ),

        'Контакти' => array(
            'id' => 10,
            'submenu' => false ),

        'Співпраця' => array(
            'id' => 11,
            'submenu' => false )

);