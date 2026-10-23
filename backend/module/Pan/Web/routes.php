<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ $router->group(array('middleware' => array(\Module\Member\Middleware\WebAuthMiddleware::class)), function () use($router) { $router->match(array('get', 'post'), 'pan', 'IndexController@index'); $router->match(array('get', 'post'), 'pan/disk', 'DiskController@index'); $router->match(array('get', 'post'), 'pan/disk_file/preview', 'DiskFileController@preview'); $router->match(array('get', 'post'), 'pan/s/{alias}', 'ShareController@index'); $router->match(array('get', 'post'), 'pan/s/{alias}/submit_code', 'ShareController@submitCode'); $router->match(array('get', 'post'), 'pan/share/preview', 'ShareController@preview'); });