<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
 
/**
 * Set the error handling
 */
//ini_set('display_errors', 1);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

// web/index.php
require_once __DIR__ . '/../vendor/autoload.php';

// Instantiate the Silex Application
$app = new Silex\Application();

// Turn on debugging
$app['debug'] = true;

// Pull in the Application Autoloader
require(__DIR__ . '/../appAutoloader.php');

/**
 *  JSON handling
 */
$app->before(function (Request $request)
{
	if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
    	$data = json_decode($request->getContent(), true);
    	$request->request->replace(is_array($data) ? $data : array());
	}
});

/**
 * Function that verifies the API is working
 */
$app->match('/api/v2/test', function (Request $request) use ($app)
{
	$json = array("message" => "API is working.");
	
	return $app->json($json);
});

/**
 * Handles retrieving user object by user id
 */
$app->match('/api/v2/userid', function(Request $request) use ($app)
{	
	// Get the requested ID
	$id = $request->get('id');

	// Instantial the User Controller
	$userSrvc = new \services\UserService();

	// Get user object based on user id
	$userModelsArr = $userSrvc->getUserDataById($id);

	// Convert the User Objects into keyed arrays
	$userArr = array();
	for ($i = 0; $i < sizeof($userModelsArr); $i++) {
		$userArr[] = $userModelsArr[$i]->getAsArray();
	}

	// Return as JSON
	return $app->json($userArr);
});

/**
 * Handles retrieving user object by user first name
 */
$app->match('/api/v2/username', function(Request $request) use ($app)
{	
	// Get the requested ID
	$name = $request->get('name');

	// Instantiate User Controller
	$userSrvc = new \services\UserService();

	// If _all is requested then return ALL users
	$userModelsArr = array();
	if ($name == '_all') {
		$userModelsArr = $userSrvc->getAllUsers();
	} else {
		// Get User Obj by user first name
		$userModelsArr = $userSrvc->getUserDataByName($name);	
	}

	// Turn user models into array to be JSON'ized
	$userArr = array();
	for ($i = 0; $i < sizeof($userModelsArr); $i++) {
		$userArr[] = $userModelsArr[$i]->getAsArray();
	}
	
	// Return as JSON
	return $app->json($userArr);
});

/**
 * Handles creating a new user
 */
$app->match('/api/v2/createuser', function(Request $request) use ($app)
{
	$fName = $request->get('firstName');
	$lName = $request->get('lastName');
	$dob = $request->get('dob');
	$phone = $request->get('phone');

	if (!isset($fName) || !isset($lName) || !isset($dob) || !isset($phone)) {
		return $app->json(array('message' => 'Missing required information.'), 500);
	}

	// Instantiate the User Controller
	$userSrvc = new \services\UserService();

	// Create the user
	$userSrvc->createNewUser($fName, $lName, $dob, $phone);

	return $app->json(array("message" => "User Created"), 201);
});

/**
 * Handles retrieving automobiles by make
 */
$app->match('/api/v2/automake', function(Request $request) use ($app)
{
	// Get requested make
	$make = $request->get('make');
	
	// Instantiate auto controller
	$autoSrvc = new \services\AutoService();

	// Get the array of auto model instances
	$autoModelArr = $autoSrvc->getAutoByMake($make);

	// Turn the models into keyed arrays for JSON'izing
	$jsonArr = array();
	for ($i = 0; $i < sizeof($autoModelArr); $i++) {
		$jsonArr[] = $autoModelArr[$i]->getAsArray();
	}

	return $app->json($jsonArr);
});

$app->run();
?>