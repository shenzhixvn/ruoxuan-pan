<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\ContentVerify; class ContentVerifyProvider { private static $instances = array(); public static function register($b8TzI) { self::$instances[] = $b8TzI; } public static function all() { foreach (self::$instances as $y0FoF => $tG00J) { if ($tG00J instanceof \Closure) { self::$instances[$y0FoF] = call_user_func($tG00J); } else { if (is_string($tG00J)) { self::$instances[$y0FoF] = app($tG00J); } } } return self::$instances; } public static function get($Fbuvw) { goto QMlqw; bNTUU: return null; goto U15Kk; FQOAe: foreach (self::all() as $nivms) { if ($nivms->name() == $Fbuvw) { return $nivms; } } goto bNTUU; QMlqw: if (empty($Fbuvw)) { return null; } goto FQOAe; U15Kk: } }