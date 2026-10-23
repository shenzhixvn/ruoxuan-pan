<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Captcha; use ModStart\Core\Exception\BizException; class CaptchaProvider { private static $instances = array(DefaultCaptchaProvider::class); public static function register($b8TzI) { self::$instances[] = $b8TzI; } public static function all() { foreach (self::$instances as $y0FoF => $tG00J) { if ($tG00J instanceof \Closure) { self::$instances[$y0FoF] = call_user_func($tG00J); } else { if (is_string($tG00J)) { self::$instances[$y0FoF] = app($tG00J); } } } return self::$instances; } public static function nameTitleMap() { return array_build(self::all(), function ($y0FoF, $tG00J) { return array($tG00J->name(), $tG00J->title()); }); } public static function get($Fbuvw) { foreach (self::all() as $nivms) { if ($nivms->name() == $Fbuvw) { return $nivms; } } return null; } public static function hasProvider() { $b8TzI = app()->config->get('CaptchaProvider'); return !empty($b8TzI); } }