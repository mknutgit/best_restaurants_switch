<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=best_restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
    /**home page**/
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisines'=> Cuisine::getAll()));
    });
    /**lists out all restaurants page & connects to cuisines**/
    $app->get("/restaurants", function() use ($app) {
        return $app['twig']->render('restaurants.html.twig', array('restaurants' => Restaurant::getAll(), 'cuisines' => Restaurant::getAll()));
    });
    /**shows single id**/
    $app->get("/restaurants/{id}", function($id) use ($app){
        $restaurants = Restaurant::find($id);
        return $app['twig']->render('restaurants.html.twig', array('$restaurants'=> $restaurants));
    });
    /**find a restaurant**/
    $app->get("/restaurants/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurants' => $restaurant));
    });
    /*edit restaurant by id*/
    $app->patch("/restaurants/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $restaurant = Restaurant::find($id);
        $restaurant->update($name);
        return $app['twig']->render('restaurants.html.twig', array('restaurant' => $restaurant));
    });

    $app->delete("/restaurants/{id}", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $restaurant->delete();
        return $app['twig']->render('index.html.twig', array('restaurant' => Restaurant::getAll()));
    });
    /*get cuisine by id*/
    $app->get("/cuisines/{id}", function($id) use ($app){
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisines.html.twig', array('cuisine'=> $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });
    /*find cuisine by id*/
    $app->get("/cuisines/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));
    });

    $app->patch("/cuisines/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $cuisine = Cuisine::find($id);
        $cuisine->update($name);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });
    $app->delete("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });
    $app->get("/total", function() use ($app){
        $cuisine = Cuisine::getAll();
        $restaurants = Restaurant::getAll();
        return $app['twig']->render('total.html.twig', array('cuisines'=> $cuisine, 'restaurants' => $restaurants));
    });
    $app->post("/restaurants", function() use ($app) {
        $description = $_POST['description'];
        $cuisine_id = $_POST['cuisine_id'];
        $due = $_POST['due'];
        $restaurant = new Restaurant($description, $id = null, $cuisine_id, $due);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        // var_dump($cuisine);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });
    $app->post("/cuisines", function() use ($app){
        $cuisine = new Cuisine($_POST['type']);
        $cuisine->save();

        return $app['twig']->render('index.html.twig', array('cuisines'=> Cuisine::getAll()));
    });
    $app->post("/delete_restaurants", function() use ($app) {
        Restaurant::deleteAll();
        return $app['twig']->render('index.html.twig');
    });
    $app->post("/delete_cuisines", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('index.html.twig');
    });


    return $app;
?>
