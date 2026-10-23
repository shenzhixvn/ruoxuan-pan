<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto dx5M8; I4fll: $router->match(array('post'), 'module_store/install', 'ModuleStoreController@install'); goto ToENY; V2WNC: $router->match(array('post'), 'module_store/upgrade', 'ModuleStoreController@upgrade'); goto cmlRo; pTmEo: $router->match(array('post'), 'module_store/enable', 'ModuleStoreController@enable'); goto ioA9G; ToENY: $router->match(array('post'), 'module_store/uninstall', 'ModuleStoreController@uninstall'); goto pTmEo; dx5M8: $router->match(array('get', 'post'), 'module_store', 'ModuleStoreController@index'); goto EdjiV; ioA9G: $router->match(array('post'), 'module_store/disable', 'ModuleStoreController@disable'); goto V2WNC; EdjiV: $router->match(array('post'), 'module_store/all', 'ModuleStoreController@all'); goto I4fll; cmlRo: $router->match(array('get', 'post'), 'module_store/config/{module}', 'ModuleStoreController@config');