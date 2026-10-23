<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto BkVGO; BkVGO: $router->match(array('get', 'post'), 'bygoukai/upgrade', 'UpgradeController@index'); goto xraLa; xraLa: $router->match(array('get', 'post'), 'bygoukai/upgrade/manual', 'UpgradeController@manual'); goto TkmjY; TkmjY: $router->match(array('get', 'post'), 'bygoukai/upgrade/info', 'UpgradeController@info');