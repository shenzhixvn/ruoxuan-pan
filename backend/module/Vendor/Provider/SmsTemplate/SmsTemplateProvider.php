<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SmsTemplate; use ModStart\Support\Concern\HasFields; class SmsTemplateProvider { private static $instances = array(); public static function register($b8TzI) { self::$instances[] = $b8TzI; } public static function all() { foreach (self::$instances as $y0FoF => $tG00J) { if ($tG00J instanceof \Closure) { self::$instances[$y0FoF] = call_user_func($tG00J); } else { if (is_string($tG00J)) { self::$instances[$y0FoF] = app($tG00J); } } } return self::$instances; } public static function map() { goto CRDOH; CRDOH: $lWvzu = array(); goto fd763; fd763: foreach (self::all() as $nivms) { $lWvzu[$nivms->name()] = array('name' => $nivms->name(), 'title' => $nivms->title(), 'description' => $nivms->description(), 'example' => $nivms->example()); } goto U8aAU; U8aAU: return $lWvzu; goto a2Zo9; a2Zo9: } }