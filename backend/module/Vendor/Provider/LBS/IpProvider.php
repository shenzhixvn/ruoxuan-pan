<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\LBS; use Module\Vendor\Provider\ProviderTrait; class IpProvider { use ProviderTrait; public static function all() { return self::listAll(); } public static function get($Fbuvw) { return self::getByName($Fbuvw); } public static function first() { foreach (self::all() as $b8TzI) { return $b8TzI; } return null; } public static function firstResponse($Ckv43) { goto PhiE7; ILSRt: if (!$b8TzI) { return null; } goto uOvnx; uOvnx: return $b8TzI->getLocation($Ckv43); goto i5BmF; PhiE7: $b8TzI = self::first(); goto ILSRt; i5BmF: } public static function firstResponseKey($Ckv43, $dBqej = array('province')) { goto EQ2_Y; JxtBS: return join('', $Xom2X); goto MwHJ1; ile6_: if (empty($U19do)) { return ''; } goto iHPud; EYVPf: foreach ($dBqej as $nSiYr) { $Xom2X[] = $U19do->{$nSiYr}; } goto JxtBS; EQ2_Y: $U19do = self::firstResponse($Ckv43); goto ile6_; iHPud: $Xom2X = array(); goto EYVPf; MwHJ1: } }