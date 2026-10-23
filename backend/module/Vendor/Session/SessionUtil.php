<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Session; use Illuminate\Support\Facades\Session; use Module\Vendor\Atomic\AtomicUtil; class SessionUtil { public static function atomicProduce($Fbuvw, $gSrPC, $Q2xIN = 3600) { AtomicUtil::produce("{$Fbuvw}:" . Session::getId(), $gSrPC, $Q2xIN); } public static function atomicConsume($Fbuvw, $EkMzU = null) { return AtomicUtil::consume("{$Fbuvw}:" . Session::getId()); } public static function atomicRemove($Fbuvw, $EkMzU = null) { AtomicUtil::remove("{$Fbuvw}:" . Session::getId()); } }