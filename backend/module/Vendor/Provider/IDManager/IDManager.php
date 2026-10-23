<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\IDManager; class IDManager { private static $instances = array(); public static function register($b8TzI) { self::$instances[] = $b8TzI; } public static function all() { foreach (self::$instances as $y0FoF => $tG00J) { if ($tG00J instanceof \Closure) { self::$instances[$y0FoF] = call_user_func($tG00J); } else { if (is_string($tG00J)) { self::$instances[$y0FoF] = app($tG00J); } } } return self::$instances; } public static function get($Fbuvw) { goto ehmUJ; c86cZ: return null; goto T4IQu; zXlkD: foreach (self::all() as $Ks5ZF) { if ($Ks5ZF->name() == $Fbuvw) { return $Ks5ZF; } } goto c86cZ; ehmUJ: $Fbuvw = modstart_config($Fbuvw, $Fbuvw); goto zXlkD; T4IQu: } }