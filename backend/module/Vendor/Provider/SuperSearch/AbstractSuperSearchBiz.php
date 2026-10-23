<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SuperSearch; abstract class AbstractSuperSearchBiz { public abstract function name(); public abstract function title(); public abstract function fields(); public function syncBatch(AbstractSuperSearchProvider $b8TzI, $O5Sa6) { $cTRiU = array(); return array('count' => count($cTRiU), 'nextId' => $O5Sa6); } }