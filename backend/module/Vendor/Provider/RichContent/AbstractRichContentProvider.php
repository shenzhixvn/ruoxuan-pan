<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RichContent; use Module\Vendor\Html\HtmlConvertUtil; abstract class AbstractRichContentProvider { public abstract function name(); public abstract function title(); public abstract function render($Fbuvw, $gSrPC, $e1tw_ = array()); public function toHtml($gSrPC, $ml61K = null) { return HtmlConvertUtil::callInterceptors($ml61K, $gSrPC); } }