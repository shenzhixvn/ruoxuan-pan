<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Schedule; use Illuminate\Console\Scheduling\Schedule; class ScheduleProvider { private static $instances = array(); public static function register($b8TzI) { self::$instances[] = $b8TzI; } public static function all() { foreach (self::$instances as $y0FoF => $tG00J) { if ($tG00J instanceof \Closure) { self::$instances[$y0FoF] = call_user_func($tG00J); } else { if (is_string($tG00J)) { self::$instances[$y0FoF] = app($tG00J); } } } return self::$instances; } public static function call(Schedule $XV_Gb) { foreach (ScheduleProvider::all() as $b8TzI) { $XV_Gb->call(function () use($b8TzI) { call_user_func(array($b8TzI, 'run')); })->cron($b8TzI->cron()); } } }