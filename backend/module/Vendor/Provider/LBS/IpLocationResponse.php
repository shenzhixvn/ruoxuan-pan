<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\LBS; class IpLocationResponse { public static $keys = array('country', 'province', 'city', 'district', 'isp'); public static function fromArray($rSQEM) { goto qZlHO; qZlHO: $ZY4Vx = new static(); goto Yt0Io; Yt0Io: foreach (self::$keys as $nSiYr) { $ZY4Vx->{$nSiYr} = isset($rSQEM[$nSiYr]) ? $rSQEM[$nSiYr] : null; } goto KEge0; KEge0: return $ZY4Vx; goto CHZ7D; CHZ7D: } public $country; public $province; public $city; public $district; public $isp; }