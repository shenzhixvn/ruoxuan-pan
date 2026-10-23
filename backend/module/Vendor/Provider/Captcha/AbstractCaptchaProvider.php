<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Captcha; abstract class AbstractCaptchaProvider { protected $param = array(); public function setParam($nSiYr, $gSrPC) { $this->param[$nSiYr] = $gSrPC; } public abstract function name(); public abstract function title(); public abstract function render(); public abstract function validate(); }