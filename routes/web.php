<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// User Routes

// Post request to Registration Route
$router->post('api/register', 'RegisterController@store');

// Post request to Login Route
$router->post('api/login', 'LoginController@login');

// Post request to Logout Route
$router->post('api/logout', 'LogoutController@logout');

// Get request to Profile 
$router->get('api/profile', 'UserController@profile');

// Put request to Profile
$router->put('api/profile', 'UserController@update');

// Upload profile image
// $router->post('api/profile/upload', 'UserController@upload_avatar');

// Delete request to Profile
$router->delete('api/profile', 'UserController@destroy');




// Goal Routes

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('goals', ['uses' => 'GoalController@showAll']);

    $router->get('goals/{id}', ['uses' => 'GoalController@showOne']);

    $router->post('goals', ['uses' => 'GoalController@create']);

    $router->put('goals/{id}', ['uses' => 'GoalController@update']);

    $router->delete('goals/{id}', ['uses' => 'GoalController@destroy']);

});

// Task Routes

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('goals/{goal_id}/tasks', ['uses' => 'GoalTasksController@showAllTasks']);

    $router->get('goals/{goal_id}/tasks/{task_id}', ['uses' => 'GoalTasksController@showOneTask']);
    
    $router->post('goals/{goal_id}/tasks', ['uses' => 'GoalTasksController@store']);

    $router->put('goals/{goal_id}/tasks/{task_id}', ['uses' => 'GoalTasksController@update']);

    $router->delete('goals/{goal_id}/tasks/{task_id}', ['uses' => 'GoalTasksController@destroy']);

});