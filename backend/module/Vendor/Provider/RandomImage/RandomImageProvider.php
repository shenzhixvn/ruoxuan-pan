<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RandomImage; class RandomImageProvider { public static function get() { goto EAwlG; Jspmf: if (null === $A311f) { goto b5xQA; VzVu0: $A311f = app($eJ6_5); goto eyvvW; b5xQA: $eJ6_5 = config('RandomImageProvider'); goto YsMbG; YsMbG: if (empty($eJ6_5)) { $eJ6_5 = DefaultRandomImageProvider::class; } goto VzVu0; eyvvW: } goto iQjDm; EAwlG: static $A311f = null; goto Jspmf; iQjDm: return $A311f; goto LzsOk; LzsOk: } public static function getImage($NAiTX = '', $e1tw_ = array()) { return self::get()->get(array_merge(array('biz' => $NAiTX), $e1tw_)); } }