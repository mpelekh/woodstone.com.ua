<?php defined('SYSPATH') or die('No direct script access.');

class Model_Main extends Model {

    public function get_languages()
    {
        $query = DB::select()
            ->from('languages');


        return $query->execute();
    }



    public function edit_main($id, $page_id, $language, $text)
    {
        $query_subpages = DB::update('subpage')
            ->set(array(
                'page_id' => $page_id,
                'language_id' => $language,
                'type_id' => 2,
                'isImage' => 0,
            ))
            ->where('id', '=', $id)
            ->execute();

        $query_texts = DB::update('texts')
                        ->set(array(
                'text' => $text,
                 ))
            ->where('subpage_id', '=', $id)
            ->execute();

        /*$query_images = DB::update('images')
                        ->set(array(
                'image_href' => $image,
            ))
            ->where('subpage_id', '=', $id)
            ->execute();*/
    }

    public function add_main($id, $language, $text)
    {
        $query_subpages = DB::insert('subpage',  array('page_id', 'language_id', 'type_id', 'isImage', 'subpage_name'))
            ->values(array($id, $language, 2, 0, 'None'))->execute();

        $query_texts = DB::insert('texts', array('subpage_id', 'text'))
            ->values(array($query_subpages[0], $text))->execute();

        /*$query_images = DB::insert('images', array('subpage_id', 'image_href'))
            ->values(array($query_subpages[0], $image))->execute();*/

        return $query_subpages[0];
    }

    public function name_main($id, $language, $text)
    {
        $query_subpages = DB::insert('subpage', array('page_id', 'language_id', 'type_id', 'isImage', 'subpage_name'))
            ->values(array($id, $language, 2, 0, $text))->execute();
    }


} 
