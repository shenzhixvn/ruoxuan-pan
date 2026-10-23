<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Type; use ModStart\Core\Type\BaseType; class ShareStatus implements BaseType { const NORMAL = 1; const EXPIRED = 2; public static function getList() { return array(self::NORMAL => '正常', self::EXPIRED => '已过期'); } }