<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Captcha; use Illuminate\Support\Facades\View; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use ModStart\Misc\Captcha\CaptchaFacade; class DefaultCaptchaProvider extends AbstractCaptchaProvider { public function name() { return 'default'; } public function title() { return '图片验证码'; } public function render() { return View::make('module::Vendor.View.widget.captcha.default')->render(); } public function validate() { goto XRUL1; XRUL1: $bCc5F = InputPackage::buildFromInput(); goto f6cfz; f6cfz: $aZ4RY = $bCc5F->getTrimString('captcha'); goto kGNE0; tr5rm: return Response::generateSuccess(); goto zq3Jh; kGNE0: if (!CaptchaFacade::check($aZ4RY)) { return Response::generate(-1, '图片验证码错误', null, '[js]$(\'[data-captcha]\').click();'); } goto tr5rm; zq3Jh: } }