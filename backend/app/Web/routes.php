<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Support\Facades\Route; Route::group(array('namespace' => '\\App\\Web\\Controller', 'middleware' => array('web.bootstrap', \Module\Member\Middleware\WebAuthMiddleware::class)), function () { Route::match(array('get', 'post'), '', 'IndexController@index'); Route::match(array('get', 'post'), 'member', 'MemberController@index'); Route::match(array('get', 'post'), 'member/{id}', 'MemberController@show'); Route::match(array('get', 'post'), 'member_profile', 'MemberProfileController@index'); });