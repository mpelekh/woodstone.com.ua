<?php defined('SYSPATH') OR die('No direct script access.');

class HTTP_Exception_500 extends Kohana_HTTP_Exception_500 {

    /**
     * @return Response
     */
    public function get_response()
    {
        //return "Wowow";
        // Lets log the Exception, Just in case it's important!
        Kohana_Exception::log($this);

        if ( Kohana::$environment !== Kohana::PRODUCTION)
        {
            // Show the normal Kohana error page.
            return parent::get_response();
        }
        else
        {

            $view = Request::factory(URL::site('system/oops'))->execute();



            $response = Response::factory()
                ->status(500)
                ->body($view);


            return $response;
        }
    }
}