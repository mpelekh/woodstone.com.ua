<?php defined('SYSPATH') or die('No direct script access.');

class Model_Subpage extends ORM{

    protected $_table_name = 'subpage';

    protected $_belongs_to = array(
        'pages' => array(
            'model' => 'Page',
            'foreign_key' => 'page_id',
        ),

        'languages' => array(
            'model' => 'Language',
            'foreign_key' => 'language_id',
        ),

        'types' => array(
            'model' => 'Type',
            'foreign_key' => 'type_id',
        ),


    );

    protected $_has_one = array(
        'texts' => array(
            'model' => 'Text',
            'foreign_key' => 'subpage_id',
        ),

        'images' => array(
            'model' => 'Image',
            'foreign_key' => 'subpage_id',
        ),

        'info' => array(
            'model' => 'Info',
            'foreign_key' => 'subpage_id',
        ),
    );


    public function get_text($id, $lang)
    {
        $this->where('page_id', '=', $id)->and_where('language_id', '=', $lang)->find();

        return $this;
    }

    public function get_images($id)
    {
        $result = DB::select('image_href')
            ->from('images')
            ->where('subpage_id', '=', $id);

        return $result->execute();
    }

    public function add_text($id, $language, $isImage, $text, $parent_id = 0, $isInfo = 0, $measure_id = NULL, $price = NULL)
    {
        $subpage = $this;

        $subpage->page_id = $id;
        $subpage->language_id = $language;
        $subpage->type_id = 2;
        $subpage->isImage = $isImage;
        $subpage->subpage_name = 'None';
        $subpage->parent_id = $parent_id;
        $subpage->isInfo = $isInfo;
        $subpage->save();

        $subpage_id = $subpage->pk();

        $subpage->texts->subpage_id = $subpage_id;
        $subpage->texts->text = $text;
        $subpage->texts->save();

        $subpage->info->subpage_id = $subpage_id;
        $subpage->info->measure_id = $measure_id;
        $subpage->info->price = $price;
        $subpage->info->save();

        return $subpage_id;

    }

    public function edit_text($id, $page_id, $lang_id, $isImage, $text, $parent_id = 0, $isInfo = 0, $measure_id = NULL, $price = NULL, $is_from = 0)
    {
        /*$subpage = $this->where('id', '=', $id);


        $subpage->page_id = $page_id;
        $subpage->language_id = $lang_id;
        $subpage->type_id = 2;
        $subpage->isImage = $isImage;
        $subpage->subpage_name = 'None';
        $subpage->parent_id = $parent_id;
        $subpage->isInfo = $isInfo;
        $subpage->save();

        $subpage->where('subpage_id', '=', $id)->texts->text = $text;
        $subpage->texts->save();*/

        /*$subpage->info->subpage_id = $subpage_id;
        $subpage->info->measure_id = $measure_id;
        $subpage->info->price = $price;
        $subpage->info->save();*/

        $texts = ORM::factory('Text', array('subpage_id' => $id));
        $texts->text = $text;
        $texts->save();

        $info = ORM::factory('Info', array('subpage_id' => $id));
        $info->price = $price;
        $info->measure_id = $measure_id;
        $info->is_from = $is_from;
        $info->save();

        return $text;

    }

    /*public function get_products_subpages()
    {
        $this->where('page_id', '=', 3)
            ->and_where('parent_id', '=', 0)
            ->find_all()
            ->as_array('id');

        $products_sabpage = DB::select('id')
            ->from('subpage')
            ->where('page_id', '=', 3)
            ->and_where('parent_id', '=', 0)
            ->execute();

        return $products_sabpage;

    }*/

    public function get_parents_name($page_id)  //для взяття імен parent сторінок(для контролера products)
    {
        return $this->where('page_id', '=', $page_id)
                    ->and_where('parent_id', '=', 0)
                    ->find_all()
                    ->as_array();

    }

    public function get_items($id, $lang_id, $page_id)  //для взяття продукції
    {
        return $this->where('page_id', '=', $page_id)
            ->and_where('parent_id', 'IN', $id)
            ->and_where('language_id', '=', $lang_id)
            ->find_all();

    }

    public function delete_subpage($id) //для продукції
    {
        $query = ORM::factory('Subpage', $id);
        $query->delete();

        $query2 = ORM::factory('Text', array('subpage_id' => $id));
        $query2->delete();

        $query3 = ORM::factory('Info', array('subpage_id' => $id));
        $query3->delete();
    }

    public function delete_subpage_image($id) //для фотогалереї
    {
        $query = ORM::factory('Subpage', $id);
        $query->delete();

        $query2 = ORM::factory('Text', array('subpage_id' => $id));
        $query2->delete();

        $query3 = ORM::factory('Image', array('subpage_id' => $id));
        $query3->delete();
    }

    public function get_img($lang_id, $page_id)  //для взяття gallery in main
    {
        return $this->where('page_id', '=', $page_id)
            ->and_where('parent_id', '!=', 0)
            ->and_where('language_id', '=', $lang_id)
            ->limit(10)
            ->find_all();

    }

}