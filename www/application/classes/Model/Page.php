<?php defined('SYSPATH') or die('No direct script access.');

class Model_Page extends ORM {

    protected $_has_many = array(
        'subpage' => array(
            'model' => 'Subpage',
            'foreign_key' => 'page_id',
        )
    );

} 
