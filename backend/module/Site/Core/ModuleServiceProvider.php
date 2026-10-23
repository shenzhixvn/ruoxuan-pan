<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Site\Core; use Illuminate\Events\Dispatcher; use Illuminate\Support\ServiceProvider; use ModStart\Admin\Config\AdminMenu; class ModuleServiceProvider extends ServiceProvider { public function boot(Dispatcher $k4bcO) { AdminMenu::register(array(array('title' => L('Site Manage'), 'icon' => 'cog', 'sort' => 400, 'children' => array(array('title' => '网站基础配置', 'url' => '\\Module\\Site\\Admin\\Controller\\ConfigController@setting'))))); } public function register() { } }