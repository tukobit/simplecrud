<?php

require_once(__DIR__ . "/pdoclasses/easyCRUD/Person.class.php");
require_once(__DIR__ . "/pdoclasses/Log.class.php");

/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim(array(
    'templates.path' => './'
));

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$app->get('/',
    function () use ($app) {
        $app->render('home.php');
    }
);

// POST route
$app->post(
    '/api/person',
    function () use ($app) {
    	$log = new Log();	
    	$log->write("post method called");
    	$request = $app->request();
    	$receivedData = json_decode($request->getBody());

    	$person  = new Person();
    	$person->Firstname = $receivedData->Firstname;
    	$person->Lastname = $receivedData->Lastname;
    	$person->Age = $receivedData->Age;
    	$person->Sex = $receivedData->Sex;
        $log->write(json_encode($person));
        $saved = $person->Create(); 
        $log->write(json_encode($saved));
        //Construct response
        $response = $app->response();
		$response['Content-Type'] = 'application/json';
		$response->body(json_encode($saved));
        //echo 'This is a POST route';
    }
);

$app->get(
    '/api/person/',
    function () use ($app)  {
      $log = new Log();	
      $log->write("get method called");
      $response = $app->response();
      $response['Content-Type'] = 'application/json';
      $person  = new Person();
      $persons = $person->all();  
      $response->body(json_encode($persons));
    }
);

$app->get(
    '/api/person/:personId',
    function ($personId) use ($app)  {
      $log = new Log(); 
      $log->write("get method called");
      $response = $app->response();
      $response['Content-Type'] = 'application/json';
      $person  = new Person();
      $person->id = $personId;        
      $person->Find();
      $response->body(json_encode($person));
    }
);

// PUT route
$app->put(
    '/api/person',
    function () use ($app) {
    $log = new Log(); 
    $request = $app->request();
    $receivedData = json_decode($request->getBody());

    $person  = new Person();
    $person->id = $receivedData->id;
    $person->Firstname = $receivedData->Firstname;
    $person->Lastname = $receivedData->Lastname;
    $person->Age = $receivedData->Age;
    $person->Sex = $receivedData->Sex;
    $log->write(json_encode($person));
    $saved = $person->Save(); 
    $log->write(json_encode($saved));
    //Construct response
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->body(json_encode($saved));
    }
);

// PATCH route
$app->patch('/api/person/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/api/person/:personId',
    function ($personId) use ($app) {
        $person  = new Person();
        $person->id = $personId;
        $delete = $person->Delete();
      
        $response = $app->response();
        $response['Content-Type'] = 'application/json';
        $response->body(json_encode($delete));
    }
);

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();