<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\LiveStream; use ModStart\Form\Form; abstract class AbstractLiveStreamProvider { public abstract function name(); public abstract function title(); public abstract function getPushUrl($jAbNw, $kEFyW, $e1tw_ = array()); public abstract function getPlayUrl($jAbNw, $kEFyW, $e1tw_ = array()); public function pushFields(Form $y31_Y) { } }