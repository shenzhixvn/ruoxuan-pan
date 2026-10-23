<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Type; use ModStart\Core\Type\BaseType; class OrderStatus implements BaseType { const WAIT_PAY = 1; const WAIT_SHIPPING = 2; const WAIT_CONFIRM = 3; const COMPLETED = 50; const CANCEL_EXPIRED = 98; const CANCEL = 99; const CANCEL_QUEUE = 100; public static function getList() { return array(self::WAIT_PAY => '待付款', self::WAIT_SHIPPING => '待发货', self::WAIT_CONFIRM => '待收货', self::COMPLETED => '已完成', self::CANCEL_EXPIRED => '订单过期取消', self::CANCEL => '订单取消', self::CANCEL_QUEUE => '正在取消'); } public static function filterList($ByQE8) { goto iawjT; rgIQV: foreach (self::getList() as $y0FoF => $tG00J) { if (!in_array($y0FoF, $ByQE8)) { continue; } $Ashnz[$y0FoF] = $tG00J; } goto lLrKh; lLrKh: return $Ashnz; goto eKqQ4; iawjT: $Ashnz = array(); goto rgIQV; eKqQ4: } public static function simple() { return self::filterList(array(self::WAIT_PAY, self::COMPLETED, self::CANCEL_EXPIRED)); } }