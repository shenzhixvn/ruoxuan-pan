<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Recycle; use ModStart\Core\Dao\TenantModelUtil; class TenantRecycleUtil { public static function tableAdd($vtqAL, $ln7i8, $V6NFA, $rSQEM) { TenantModelUtil::insert($vtqAL, 'tenant_recycle_table', array('table' => $ln7i8, 'tableId' => $V6NFA, 'content' => json_encode($rSQEM))); } }