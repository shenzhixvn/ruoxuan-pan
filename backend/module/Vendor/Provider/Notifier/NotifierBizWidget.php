<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Notifier; class NotifierBizWidget { private static $list = array(); public static function register($NAiTX, $r3C0p) { self::$list[] = array('biz' => $NAiTX, 'title' => $r3C0p); } public static function get() { return self::$list; } }