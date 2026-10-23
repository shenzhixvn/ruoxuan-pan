<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto FMYnf; FMYnf: $router->match(array('get', 'post'), 'article', 'ArticleController@index'); goto y5vwg; NxNzu: $router->match(array('get', 'post'), 'article/edit', 'ArticleController@edit'); goto XawW0; XawW0: $router->match(array('get', 'post'), 'article/delete', 'ArticleController@delete'); goto WKhhR; y5vwg: $router->match(array('get', 'post'), 'article/add', 'ArticleController@add'); goto NxNzu; WKhhR: $router->match(array('get', 'post'), 'article/show', 'ArticleController@show');