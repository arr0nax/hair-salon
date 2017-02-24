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
        $stylists = Stylist::getAll();
        return $app['twig']->render("root.html.twig", ['stylists' => $stylists]);
    });

    $app->post('/addstylist', function() use($app) {
        $name = $_POST['name'];
        $new_stylist = new Stylist($name);
        $new_stylist->save();
        return $app->redirect('/');
    });

    $app->get('/editstylist/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render("stylist.html.twig", ['stylist' => $stylist]);
    });

    $app->patch('/editstylist/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        $stylist->update($_POST['name']);
        return $app->redirect('/editstylist/'.$id);
    });

    $app->delete('/editstylist/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app->redirect('/');
    });

    return $app;






 ?>
