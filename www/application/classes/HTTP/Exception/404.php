<?php defined('SYSPATH') OR die('No direct script access.');

class HTTP_Exception_404 extends Kohana_HTTP_Exception_404 {

    /**
     * Generate a Response for the 404 Exception.
     *
     * The user should be shown a nice 404 page.
     *
     * @return Response
     */
   /* public function get_response()
    {
        $view = View::factory('frontend/errors/404');

        // Remembering that `$this` is an instance of HTTP_Exception_404
        $view->message = $this->getMessage();

        $response = Response::factory()
            ->status(404)
            ->body($view->render());

        return $response;
    }*/

    public function get_response()
    {
        // Lets log the Exception, Just in case it's important!
        //Kohana_Exception::log($this);

        if ( Kohana::$environment == Kohana::PRODUCTION)
        {
            // Show the normal Kohana error page.
            return parent::get_response();
        }
        else
        {

            $view = Request::factory(URL::site('system/404'))->execute();



            $response = Response::factory()
                ->status(404)
                ->body($view);


            return $response;
        }
    }
}