<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Util; use Illuminate\Support\Facades\Session; use ModStart\Core\Dao\ModelUtil; use Module\Pan\Type\ShareType; class DiskShareUtil { public static function getByAlias($Bx0Rw) { goto LDNRG; NfEaj: return $z5hSx; goto SgxFe; OK9Xx: if (empty($z5hSx)) { return null; } goto eHgnx; oG2pe: if ($z5hSx['expireTime'] && strtotime($z5hSx['expireTime']) < time()) { return null; } goto NfEaj; LDNRG: $z5hSx = ModelUtil::get('pan_share', array('alias' => $Bx0Rw)); goto OK9Xx; eHgnx: ModelUtil::decodeRecordJson($z5hSx, array('fileIds')); goto oG2pe; SgxFe: } public static function getVisitAuth($Vg0E7) { return intval(Session::get('Pan:ShareShow:' . $Vg0E7['id'], 0)); } public static function putVisitAuth($Vg0E7) { Session::put('Pan:ShareShow:' . $Vg0E7['id'], time()); } public static function hasVisitAuth($Vg0E7) { switch ($Vg0E7['type']) { case ShareType::TYPE_PUBLIC: return true; case ShareType::TYPE_PRIVATE: return self::getVisitAuth($Vg0E7) > 0; } return false; } }