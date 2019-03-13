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

$router->get('api/profile', 'UserController@profile');

$router->post('api/logout', 'LogoutController@logout');


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
    
    $router->post('goals/{id}/tasks', ['uses' => 'GoalTasksController@store']);

    $router->put('goals/tasks/{id}', ['uses' => 'GoalTasksController@update']);

});