<?php
header('Access-Control-Allow-Origin: *');
$router->group(['prefix' => 'dashboard'/*,, 'middleware' => ['validatecurrentuser'] */], function () use ($router) {
    $router->group(['prefix' => 'v1', 'namespace' => 'v1'], function () use ($router) {
        $router->get('getGoogleAnalyticReport', 'GoogleAnalyticsReportController@getWebsiteVisitorsLinechartPerDay');
        $router->get('getsimpleData', 'GoogleAnalyticsReportController@getsimpleData');
        $router->get('getSearchData', 'GoogleAnalyticsReportController@SearchData');
    });
});
