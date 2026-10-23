<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Html; use ModStart\Core\Util\HtmlUtil; use Module\Vendor\Markdown\MarkdownUtil; class HtmlConverter { public static function convertToHtml($CVFrO, $Zr532, $Amcgu = null) { goto bjN0A; CVxEv: return $Mj1_5; goto DTTlf; bjN0A: switch ($CVFrO) { case HtmlType::RICH_TEXT: $Mj1_5 = HtmlUtil::filter($Zr532); break; case HtmlType::MARKDOWN: goto wJPCT; mZRf4: $Mj1_5 = HtmlUtil::filter($Mj1_5); goto TtEHQ; TtEHQ: break; goto Aw6CX; wJPCT: $Mj1_5 = MarkdownUtil::convertToHtml($Zr532); goto mZRf4; Aw6CX: case HtmlType::SIMPLE_TEXT: $Mj1_5 = HtmlUtil::text2html($Zr532); break; default: throw new \Exception('HtmlConverter.convertToHtml contentType error'); } goto j5ykH; j5ykH: if (!empty($Amcgu)) { if (is_array($Amcgu)) { foreach ($Amcgu as $lztBT) { $MygHD = new $lztBT(); $Mj1_5 = $MygHD->convert($Mj1_5); } } else { $MygHD = new $Amcgu(); $Mj1_5 = $MygHD->convert($Mj1_5); } } goto CVxEv; DTTlf: } }