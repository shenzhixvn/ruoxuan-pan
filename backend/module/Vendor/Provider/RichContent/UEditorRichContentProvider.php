<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RichContent; use Illuminate\Support\Facades\View; use ModStart\Core\Util\HtmlUtil; use Module\Vendor\Html\HtmlConvertUtil; class UEditorRichContentProvider extends AbstractRichContentProvider { const NAME = 'htmlUEditor'; public function name() { return self::NAME; } public function title() { return 'UEditor富文本'; } public function render($Fbuvw, $gSrPC, $e1tw_ = array()) { return View::make('module::Vendor.View.widget.richContent.htmlUeditor', array('name' => $Fbuvw, 'value' => $gSrPC, 'param' => $e1tw_))->render(); } public function toHtml($gSrPC, $ml61K = null) { $gSrPC = HtmlUtil::filter($gSrPC); return parent::toHtml($gSrPC, $ml61K); } }