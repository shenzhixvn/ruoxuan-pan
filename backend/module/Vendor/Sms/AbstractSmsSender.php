<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Sms; abstract class AbstractSmsSender { protected abstract function sendExecute($F7GAs, $nijpt, $ke9I4, $e1tw_ = array()); public function send($F7GAs, $nijpt, $ke9I4, $e1tw_ = array()) { return $this->sendExecute($F7GAs, $nijpt, $ke9I4, $e1tw_); } }