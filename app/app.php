<?php
    date_default_timezone_set("America/Los_Angeles");

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), ["twig.path" => __DIR__."/../views"]);
    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use($app) {
        $name = 'jack lantern';
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $name2 = 'hazel ween';
        $id2 = null;
        $test_stylist2 = new Stylist($name2, $id2);
        $test_stylist->save();
        $test_stylist2->save();
        $stylists = Stylist::getAll();
        return $app['twig']->render("root.html.twig", ['stylists' => $stylists]);
    });

    return $app;






 ?>
