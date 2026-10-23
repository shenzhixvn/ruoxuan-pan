<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SiteUrl; use ModStart\Core\Exception\BizException; class SiteUrlProvider { private static $list = array(); private static $init = false; public static function register($b8TzI) { self::$list[] = $b8TzI; } public static function get() { if (!self::$init) { self::$init = true; foreach (self::$list as $y0FoF => $tG00J) { if (is_string($tG00J)) { self::$list[$y0FoF] = app($tG00J); } } } return self::$list; } public static function update($a1OPB, $r3C0p = '', $e1tw_ = array()) { BizException::throwsIfEmpty('SiteUrlProvider.Error -> url empty', $a1OPB); foreach (self::get() as $A311f) { $A311f->update($a1OPB, $r3C0p, $e1tw_); } } public static function delete($a1OPB) { BizException::throwsIfEmpty('SiteUrlProvider.Error -> url empty', $a1OPB); foreach (self::get() as $A311f) { $A311f->delete($a1OPB); } } }