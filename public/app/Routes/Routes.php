<?php

namespace app\Routes;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
    public static function get()
    {

        // Init basic route
        $route = new Route(
            '/',
            array('controller' => 'app\Controller\Pages', 'method' => 'index')
        );

        // Init basic pages
        $pages = new Route(
            '/{page}',
            array('controller' => 'app\Controller\Pages', 'method' => 'render')
        );

        // Init route with dynamic placeholders
        //$foo_placeholder_route = new Route(
        //    '/foo/{id}',
        //    array('controller' => 'FooController', 'method' => 'load'),
        //    array('id' => '[0-9]+')
        //);

        // Add Route object(s) to RouteCollection object
        $routes = new RouteCollection();
        $routes->add('index', $route);
        $routes->add('pages', $pages);

        return $routes;

    }
}
