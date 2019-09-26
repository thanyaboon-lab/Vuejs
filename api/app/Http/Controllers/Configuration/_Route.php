<?php
header('Access-Control-Allow-Origin: *');
$router->group(['prefix' => 'config'/*, 'middleware' => ['validatecurrentuser'] */], function () use ($router) {
    $router->group(['prefix' => 'v1', 'namespace' => 'v1'], function () use ($router) {
        $router->get('getModuleMenu', 'ConfigurationController@getModuleMenu');
    });
});
