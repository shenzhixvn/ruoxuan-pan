<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RichContent; use Module\Vendor\Provider\RichContent\AbstractRichContentProvider; use Module\Vendor\Provider\RichContent\UEditorRichContentProvider; class RichContentProvider { private static $instances = array(UEditorRichContentProvider::class); public static function register($b8TzI) { self::$instances[] = $b8TzI; } public static function all() { foreach (self::$instances as $y0FoF => $tG00J) { if ($tG00J instanceof \Closure) { self::$instances[$y0FoF] = call_user_func($tG00J); } else { if (is_string($tG00J)) { self::$instances[$y0FoF] = app($tG00J); } } } return self::$instances; } public static function getByName($Fbuvw) { foreach (self::all() as $A311f) { if ($A311f->name() == $Fbuvw) { return $A311f; } } return null; } }