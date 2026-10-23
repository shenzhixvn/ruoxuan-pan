<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RichContent; use ModStart\Core\Type\BaseType; class RichContentProviderType implements BaseType { public static function getList() { return array_build(RichContentProvider::all(), function ($y0FoF, $tG00J) { return array($tG00J->name(), $tG00J->title()); }); } }