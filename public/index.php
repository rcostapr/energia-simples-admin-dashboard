<?php
require __DIR__ . "/init.php";

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

use app\Routes\Routes;

try
{
    $routes = Routes::get();

    // Init RequestContext object
    $context = new RequestContext();
    $context->fromRequest(Request::createFromGlobals());

    // Init UrlMatcher object
    $matcher = new UrlMatcher($routes, $context);

    // Find the current route
    $parameters = $matcher->match($context->getPathInfo());

    $class = new $parameters["controller"];
    $method = $parameters["method"];
    /*
    How to generate a SEO URL
    $generator = new UrlGenerator($routes, $context);
    $url = $generator->generate('foo_placeholder_route', array(
    'id' => 123,
    ));
     */

    /*
    echo '<pre>';
    print_r($parameters);
    echo 'Generated URL: ' . $url;
     */

    echo $class->$method($parameters);
    exit;
} catch (ResourceNotFoundException $e) {
    echo $e->getMessage();
}
