<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Article\Util; use Illuminate\Support\Facades\Cache; use ModStart\Core\Dao\ModelUtil; use Module\Article\Type\ArticlePosition; class ArticleUtil { const CACHE_KEY_PREFIX = 'article:'; public static function get($wPLdk) { return ModelUtil::get('article', $wPLdk); } public static function getByAlias($Bx0Rw) { return ModelUtil::get('article', array('alias' => $Bx0Rw)); } public static function listByPosition($tJ9gP = 'home') { return ModelUtil::model('article')->where(array('position' => $tJ9gP))->orderBy('sort', 'asc')->get()->toArray(); } public static function listByPositionWithCache($tJ9gP = 'home', $nUMaP = 600) { return Cache::remember(self::CACHE_KEY_PREFIX . $tJ9gP, $nUMaP, function () use($tJ9gP) { return self::listByPosition($tJ9gP); }); } public static function clearCache() { foreach (ArticlePosition::getList() as $y0FoF => $DNpFv) { Cache::forget(self::CACHE_KEY_PREFIX . $y0FoF); } } }