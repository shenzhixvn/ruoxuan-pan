<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SuperSearch; use ModStart\Core\Type\BaseType; class SuperSearchProviderType implements BaseType { public static function getList() { return array_merge(array('' => '默认'), SuperSearchProvider::allMap()); } }