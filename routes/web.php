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
$router->post('api/register', 'RegisterController@store');

$router->post('api/login', 'LoginController@login');

$router->post('api/logout', 'LogoutController@logout');

$router->get('api/profile', 'UserController@profile');

$router->put('api/profile', 'UserController@update');

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

    $router->get('goals/{goal_id}/tasks', ['uses' => 'GoalTasksController@showAll']);

    $router->get('goals/{goal_id}/tasks/{task_id}', ['uses' => 'GoalTasksController@showOne']);
    
    $router->post('goals/{goal_id}/tasks', ['uses' => 'GoalTasksController@create']);

    $router->put('goals/{goal_id}/tasks/{task_id}', ['uses' => 'GoalTasksController@update']);

    $router->delete('goals/{goal_id}/tasks/{task_id}', ['uses' => 'GoalTasksController@destroy']);

});