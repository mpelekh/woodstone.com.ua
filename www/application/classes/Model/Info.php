<?php defined('SYSPATH') or die('No direct script access.');

class Model_Info extends ORM {

    protected $_table_name = 'info';

    protected $_belongs_to = array(
        'measures' => array(
            'model' => 'Measure',
            'foreign_key' => 'measure_id',
        )
    );


} 
