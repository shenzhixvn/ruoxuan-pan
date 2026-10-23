<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\AdminManager\Util; use ModStart\ModStart; use ModStart\Module\ModuleManager; class ModuleUtil { public static function modules() { goto DR3h2; DR3h2: $kQvBO = array(); goto CbqGd; dhdEC: return $kQvBO; goto k0FC6; CbqGd: $kQvBO[] = 'ModStart:' . ModStart::$version; goto ZadmK; ZadmK: foreach (ModuleManager::listAllEnabledModules() as $h7kjH => $DNpFv) { $vEwoS = ModuleManager::getModuleBasic($h7kjH); $kQvBO[] = "{$h7kjH}:{$vEwoS['version']}"; } goto dhdEC; k0FC6: } }