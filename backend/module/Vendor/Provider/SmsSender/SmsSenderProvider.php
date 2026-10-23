<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SmsSender; use ModStart\Core\Exception\BizException; class SmsSenderProvider { private static $instances = array(); public static function register($b8TzI) { self::$instances[] = $b8TzI; } public static function all() { foreach (self::$instances as $y0FoF => $tG00J) { if ($tG00J instanceof \Closure) { self::$instances[$y0FoF] = call_user_func($tG00J); } else { if (is_string($tG00J)) { self::$instances[$y0FoF] = app($tG00J); } } } return self::$instances; } public static function get($Fbuvw) { foreach (self::all() as $nivms) { if ($nivms->name() == $Fbuvw) { return $nivms; } } BizException::throws('没有找到SmsSenderProvider'); } public static function hasProvider() { $b8TzI = app()->config->get('SmsSenderProvider'); return !empty($b8TzI); } }