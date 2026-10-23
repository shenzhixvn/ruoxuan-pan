<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Html; class HtmlConvertUtil { public static function callInterceptors($Amcgu, $gSrPC) { goto pFTnb; pFTnb: if (empty($Amcgu)) { return $gSrPC; } goto jSmAI; TUyUF: foreach ($Amcgu as $lztBT) { $A311f = app($lztBT); $gSrPC = $A311f->convert($gSrPC); } goto vaxDA; jSmAI: if (!is_array($Amcgu)) { $Amcgu = array($Amcgu); } goto TUyUF; vaxDA: return $gSrPC; goto Cj5kH; Cj5kH: } }