<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SearchBox; use Module\Vendor\Provider\ProviderTrait; class SearchBoxProvider { use ProviderTrait; public static function all() { goto ubgnT; ubgnT: $cTRiU = self::listAll(); goto Osz4C; uYru0: return $cTRiU; goto i29E8; Osz4C: usort($cTRiU, function ($zST5I, $V0KTT) { if ($zST5I->order() == $V0KTT->order()) { return 0; } return $zST5I->order() > $V0KTT->order() ? 1 : -1; }); goto uYru0; i29E8: } public static function get($Fbuvw) { return self::getByName($Fbuvw); } public static function count() { return count(self::all()); } }