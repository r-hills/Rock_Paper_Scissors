<?php
    // Dependencies
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/RockPaperScissors.php";

    // For BSOD and other serious error debugging uncomment these lines:
    // use Symfony\Componet\Debug\Debug;
    // Debug::enable();


    // Initialize application object
    $app = new Silex\Application();

    // Uncomment line below for debug messages
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    // Use 'echo' and 'var_dump($array_name)' for variable content debugging

    // Route for root directory to display contact entry form and all contacts
    $app->get("/", function() use ($app) {
        return $app['twig']->render('form.html.twig');
    });

    $app->get("/results", function() use($app) {
        $my_RockPaperScissors = new RockPaperScissors;
        // $user_input = $_GET['user_input'];
        // $system_input = $_GET['system_input'];
        // $possibilities = array($_GET['ana1'],$_GET['ana2'],$_GET['ana3']);

        $results = $my_RockPaperScissors->playRockPaperScissors($_GET['user_input'], $_GET['system_input']);

        $user1 = $results[0];
        $user2 = $results[1];
        $result = $results[2];

        // echo $pick;
        // echo $result;

        return $app['twig']->render('results.html.twig', array('user1' => $user1, 'user2' => $user2,'result' => $result));
    });

    return $app;

?>
