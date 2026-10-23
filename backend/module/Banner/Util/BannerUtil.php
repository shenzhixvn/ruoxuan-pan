<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Banner\Util; use Illuminate\Support\Facades\Cache; use ModStart\Core\Dao\ModelUtil; use Module\Banner\Type\BannerPosition; class BannerUtil { const CACHE_KEY_PREFIX = 'banner:'; public static function listByPosition($tJ9gP = 'home') { return ModelUtil::model('banner')->where(array('position' => $tJ9gP))->orderBy('sort', 'asc')->get()->toArray(); } public static function listByPositionWithCache($tJ9gP = 'home', $nUMaP = 60) { return Cache::remember(self::CACHE_KEY_PREFIX . $tJ9gP, $nUMaP, function () use($tJ9gP) { return self::listByPosition($tJ9gP); }); } public static function insertIfMissing($tJ9gP, $rSQEM) { $rSQEM['position'] = $tJ9gP; if (!ModelUtil::exists('banner', $rSQEM)) { ModelUtil::insert('banner', $rSQEM); } } public static function hasData($tJ9gP = 'home') { return !empty(self::listByPositionWithCache($tJ9gP)); } public static function clearCache() { foreach (BannerPosition::getList() as $y0FoF => $DNpFv) { Cache::forget(self::CACHE_KEY_PREFIX . $y0FoF); } } }