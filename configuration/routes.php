<?php

/**
 * $route['home']               = 'HomeController@index';
 * $route['contact-us.aspx']    = 'HomeController@contactus';
 * $route['about-us.jsp']       = 'HomeController@__404';
 */
$route['default'] = 'AuthController@index';
$route['home'] = 'AuthController@index';
$route['login'] = 'AuthController@login';
$route['logout'] = 'AuthController@logout';
$route['dashboard'] = 'UsersController@dashboard';
$route['users'] = 'UsersController@dashboard';
$route['elastic-search'] = 'UsersController@searchEngine';
$route['algolia'] = 'UsersController@algoliaSearch';
