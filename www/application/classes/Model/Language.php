<?php defined('SYSPATH') or die('No direct script access.');

class Model_Language extends ORM {

    protected $_has_many = array(
        'subpage' => array(
            'model' => 'Subpage',
            'foreign_key' => 'language_id',
        )
    );

} 
