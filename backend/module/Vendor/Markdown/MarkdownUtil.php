<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Markdown; use Illuminate\Support\Str; class MarkdownUtil { public static function convertToHtml($VJPJL) { goto LiS1z; RU1Id: return $LxHqR->convertToHtml($VJPJL); goto CLKLY; LiS1z: if (PHP_VERSION_ID >= 80000) { return Str::of($VJPJL)->markdown(); } goto rB4Bm; rB4Bm: $LxHqR = new MarkConverter(array('renderer' => array('soft_break' => '<br />'))); goto RU1Id; CLKLY: } }