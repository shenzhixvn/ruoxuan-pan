<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class WorkPosition implements BaseType { public static function getList() { goto d7ia7; i_DZ9: if (null === $lWvzu) { $lWvzu = array(); foreach (array('普通职工', '中层管理者', '高层管理者', '企业主') as $nivms) { $lWvzu[$nivms] = $nivms; } } goto B10hU; B10hU: return $lWvzu; goto YvemQ; d7ia7: static $lWvzu = null; goto i_DZ9; YvemQ: } }