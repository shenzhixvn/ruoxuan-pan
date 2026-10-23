<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Recycle; use ModStart\Core\Dao\ModelUtil; class RecycleUtil { public static function tableAdd($ln7i8, $V6NFA, $rSQEM) { ModelUtil::insert('recycle_table', array('table' => $ln7i8, 'tableId' => $V6NFA, 'content' => json_encode($rSQEM))); } }