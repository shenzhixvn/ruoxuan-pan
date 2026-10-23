<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Captcha; use Illuminate\Support\Facades\View; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use ModStart\Misc\Captcha\CaptchaFacade; class DefaultCaptchaProvider extends AbstractCaptchaProvider { public function render() { return View::make('module::Vendor.View.widget.captcha.default')->render(); } public function validate() { goto SN_4x; Yb7Go: if (!CaptchaFacade::check($aZ4RY)) { return Response::generate(-1, '图片验证码错误', null, '[js]$(\'[data-captcha]\').click();'); } goto DpQ78; MxCWr: $aZ4RY = $bCc5F->getTrimString('captcha'); goto Yb7Go; DpQ78: return Response::generateSuccess(); goto JVLyv; SN_4x: $bCc5F = InputPackage::buildFromInput(); goto MxCWr; JVLyv: } }