<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Biz; trait BizTrait { private static $list = array(); public static function register($NAiTX) { self::$list[] = $NAiTX; } public static function registerAll(...$m9iB_) { foreach ($m9iB_ as $NAiTX) { self::register($NAiTX); } } public static function listAll() { foreach (self::$list as $y0FoF => $tG00J) { if ($tG00J instanceof \Closure) { self::$list[$y0FoF] = call_user_func($tG00J); } else { if (is_string($tG00J)) { self::$list[$y0FoF] = app($tG00J); } } } return self::$list; } private static function getByName($Fbuvw) { foreach (self::all() as $nivms) { if ($nivms->name() == $Fbuvw) { return $nivms; } } return null; } public static function allMap() { return array_build(self::all(), function ($y0FoF, $tG00J) { return array($tG00J->name(), $tG00J->title()); }); } }