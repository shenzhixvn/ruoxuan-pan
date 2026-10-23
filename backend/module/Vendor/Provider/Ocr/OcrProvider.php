<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Ocr; use Module\Vendor\Provider\ProviderTrait; class OcrProvider { use ProviderTrait; public static function all() { return self::listAll(); } public static function get($Fbuvw) { return self::getByName($Fbuvw); } public static function first() { foreach (self::all() as $b8TzI) { return $b8TzI; } return null; } }