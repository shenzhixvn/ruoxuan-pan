<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto leNNo; leNNo: $router->match(array('get', 'post'), 'install/ping', 'InstallController@ping'); goto Sg44E; pXNiY: $router->match(array('get', 'post'), 'install/execute', 'InstallController@execute'); goto qGlt0; Sg44E: $router->match(array('get', 'post'), 'install/prepare', 'InstallController@prepare'); goto pXNiY; KyMLI: $router->match(array('get', 'post'), 'captcha/image', 'CaptchaController@image'); goto WAShj; qGlt0: $router->match(array('get', 'post'), 'install/lock', 'InstallController@lock'); goto KyMLI; WAShj: $router->match(array('get'), 'placeholder/{width}x{height}', '\\Module\\Vendor\\Web\\Controller\\PlaceholderController@index'); goto KnaUY; KnaUY: $router->group(array('middleware' => array(\Module\Vendor\Middleware\NoneLoginOperateAuthMiddleware::class)), function () use($router) { $router->match(array('get', 'post'), 'content_verify/{name}', 'ContentVerifyController@index'); });