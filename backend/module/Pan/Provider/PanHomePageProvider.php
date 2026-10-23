<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Provider; use Module\Vendor\Provider\HomePage\AbstractHomePageProvider; class PanHomePageProvider extends AbstractHomePageProvider { const ACTION = '\\Module\\Pan\\Web\\Controller\\IndexController@index'; public function title() { return '网盘系统'; } public function action() { return self::ACTION; } }