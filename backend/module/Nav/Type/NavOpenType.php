<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Type; use ModStart\Core\Type\BaseType; class NavOpenType implements BaseType { const CURRENT_WINDOW = 1; const NEW_BLANK = 2; public static function getList() { return array(self::CURRENT_WINDOW => '当前窗口', self::NEW_BLANK => '新窗口'); } public static function getBlankAttributeFromValue($gF3Eh) { goto KamA0; QRx5K: if (is_array($gF3Eh)) { $gF3Eh = isset($gF3Eh['openType']) ? $gF3Eh['openType'] : null; } goto j_IHs; j_IHs: switch ($gF3Eh) { case self::NEW_BLANK: return 'target="_blank"'; } goto FyyeU; FyyeU: return ''; goto eblLN; KamA0: if (empty($gF3Eh)) { return ''; } goto QRx5K; eblLN: } }