<?php defined('SYSPATH') or die('No direct script access.');

class Model_Image extends ORM {

    public function insert_image($subpage_id, $image_href)
    {
        $this->subpage_id = $subpage_id;
        $this->image_href = $image_href;
        $this->save();
    }

}
