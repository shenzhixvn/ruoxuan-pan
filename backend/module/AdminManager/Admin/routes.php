<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto chzl3; chzl3: $router->match(array('get', 'post'), 'upgrade', 'UpgradeController@index'); goto ThLhc; ThLhc: $router->match(array('get', 'post'), 'upgrade/info', 'UpgradeController@info'); goto L_dIR; L_dIR: $router->match(array('get', 'post'), 'upgrade/auth', 'UpgradeController@auth');