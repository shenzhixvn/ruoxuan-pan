<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Cache; use Illuminate\Support\Facades\Cache; class CacheUtil { private static function client() { return Cache::store(); } public static function rememberForever($nSiYr, $hiZ1n) { return self::client()->rememberForever($nSiYr, $hiZ1n); } public static function remember($nSiYr, $Lg8xb, $hiZ1n) { return self::client()->remember($nSiYr, intval($Lg8xb / 60), $hiZ1n); } public static function forget($nSiYr) { return self::client()->forget($nSiYr); } public static function get($nSiYr) { return self::client()->get($nSiYr); } public static function put($nSiYr, $gSrPC, $Lg8xb) { self::client()->put($nSiYr, $gSrPC, ceil($Lg8xb / 60)); } public static function forever($nSiYr, $gSrPC) { self::client()->forever($nSiYr, $gSrPC); } }