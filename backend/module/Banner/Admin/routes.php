<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto y3P3M; y8dVE: $router->match(array('get', 'post'), 'banner/edit', '\\Module\\Banner\\Admin\\Controller\\BannerController@edit'); goto xJa6y; uYgUs: $router->match(array('get', 'post'), 'banner/add', '\\Module\\Banner\\Admin\\Controller\\BannerController@add'); goto y8dVE; xJa6y: $router->match(array('get', 'post'), 'banner/delete', '\\Module\\Banner\\Admin\\Controller\\BannerController@delete'); goto wJ1FK; wJ1FK: $router->match(array('get', 'post'), 'banner/show', '\\Module\\Banner\\Admin\\Controller\\BannerController@show'); goto LRcms; y3P3M: $router->match(array('get', 'post'), 'banner', '\\Module\\Banner\\Admin\\Controller\\BannerController@index'); goto uYgUs; LRcms: $router->match(array('get', 'post'), 'banner/sort', '\\Module\\Banner\\Admin\\Controller\\BannerController@sort');