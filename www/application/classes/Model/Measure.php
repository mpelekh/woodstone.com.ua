<?php defined('SYSPATH') or die('No direct script access.');

class Model_Measure extends ORM {

    protected $_has_many = array(
        'info' => array(
            'model' => 'Info',
            'foreign_key' => 'id',
        )
    );

    public function get_measures()
    {
        $measures = $this->find_all()->as_array();
        return $measures;
    }
} 
