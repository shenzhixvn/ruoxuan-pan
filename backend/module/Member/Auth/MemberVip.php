<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Auth; use Module\Member\Util\MemberVipUtil; class MemberVip { public static function get($nSiYr = null, $EvPi4 = null) { goto y8SZ2; y8SZ2: static $V3RE1 = null; goto dNQ_P; TsN_3: if (null !== $nSiYr) { return isset($V3RE1[$nSiYr]) ? $V3RE1[$nSiYr] : $EvPi4; } goto a2_Ni; a2_Ni: return $V3RE1; goto MZg7j; dNQ_P: if (null === $V3RE1) { $V3RE1 = MemberVipUtil::getMemberVip(MemberUser::user()); } goto TsN_3; MZg7j: } public static function isDefault() { return self::get('isDefault', false); } }