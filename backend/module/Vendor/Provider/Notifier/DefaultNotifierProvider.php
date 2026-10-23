<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Notifier; use Illuminate\Support\Facades\Log; class DefaultNotifierProvider extends AbstractNotifierProvider { public function notify($NAiTX, $r3C0p, $Zr532, $e1tw_ = array()) { Log::info(sprintf('DefaultNotifierProvider - %s - %s - %s', $NAiTX, $r3C0p, json_encode($Zr532, JSON_UNESCAPED_UNICODE))); } }