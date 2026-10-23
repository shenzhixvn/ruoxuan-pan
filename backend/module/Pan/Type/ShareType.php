<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Type; use ModStart\Core\Type\BaseType; class ShareType implements BaseType { const TYPE_PUBLIC = 1; const TYPE_PRIVATE = 2; public static function getList() { return array(self::TYPE_PUBLIC => '公开', self::TYPE_PRIVATE => '私密'); } }