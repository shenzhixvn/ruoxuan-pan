<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\SDK; use Module\Vendor\Cache\CacheUtil; trait CacheTrait { protected function cacheRememberForever($nSiYr, $hiZ1n) { return CacheUtil::rememberForever('ThirdParty:' . $nSiYr, $hiZ1n); } protected function cacheRemember($nSiYr, $Lg8xb, $hiZ1n) { return CacheUtil::remember('ThirdParty:' . $nSiYr, $Lg8xb, $hiZ1n); } protected function cacheForget($nSiYr) { return CacheUtil::forget('ThirdParty:' . $nSiYr); } protected function cacheGet($nSiYr) { return CacheUtil::get('ThirdParty:' . $nSiYr); } protected function cachePut($nSiYr, $gSrPC, $Lg8xb) { CacheUtil::put('ThirdParty:' . $nSiYr, $gSrPC, $Lg8xb); } }