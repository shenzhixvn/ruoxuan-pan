<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Config; class MemberAdminList { private static $gridFields = array(); public static function registerGridField(\Closure $hiZ1n) { self::$gridFields[] = $hiZ1n; } public static function callGridField($xD3VI) { foreach (self::$gridFields as $hiZ1n) { call_user_func_array($hiZ1n, array($xD3VI)); } } }