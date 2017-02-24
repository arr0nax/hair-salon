<?php
    date_default_timezone_set("America/Los_Angeles");

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

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
        $clients = Client::getAll();
        return $app['twig']->render("root.html.twig", ['stylists' => $stylists, 'clients' => $clients]);
    });

    $app->post('/addstylist', function() use($app) {
        $name = $_POST['name'];
        $new_stylist = new Stylist($name);
        $new_stylist->save();
        return $app->redirect('/');
    });

    $app->post('/addclient', function() use($app) {
        $name = $_POST['name'];
        $stylist_id = $_POST['stylist_id'];
        $new_client = new Client($name, $stylist_id);
        $new_client->save();
        return $app->redirect('/stylist/'.$stylist_id);
    });

    $app->get('/stylist/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        $clients = $stylist->getClients();
        return $app['twig']->render("stylist.html.twig", ['stylist' => $stylist, 'clients' => $clients]);
    });

    $app->get('/client/{id}', function($id) use($app) {
        $stylists = Stylist::getAll();
        $client = Client::find($id);
        return $app['twig']->render("client.html.twig", ['stylists' => $stylists, 'client' => $client]);
    });

    $app->patch('/editstylist/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        $stylist->update($_POST['name']);
        return $app->redirect('/stylist/'.$id);
    });

    $app->patch('/editclient/{id}', function($id) use($app) {
        $client = Client::find($id);
        $client->update($_POST['name'], $_POST['stylist_id']);
        return $app->redirect('/client/'.$id);
    });

    $app->delete('/editstylist/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app->redirect('/');
    });

    $app->delete('/editclient/{id}', function($id) use($app) {
        $client = Client::find($id);
        $client->delete();
        return $app->redirect('/');
    });

    return $app;






 ?>
