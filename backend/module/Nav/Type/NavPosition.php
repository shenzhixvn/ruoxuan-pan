<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Type; use ModStart\Core\Type\BaseType; use ModStart\Module\ModuleManager; use Module\Nav\Biz\NavPositionBiz; class NavPosition implements BaseType { public static function getList() { return array_merge(ModuleManager::getModuleConfigKeyValueItems('Nav', 'position'), NavPositionBiz::allMap()); } public static function first() { goto KsEuT; WC8LA: return array_shift($dBqej); goto tCfJW; KsEuT: $vT0cL = self::getList(); goto wBoyP; wBoyP: $dBqej = array_keys($vT0cL); goto WC8LA; tCfJW: } }