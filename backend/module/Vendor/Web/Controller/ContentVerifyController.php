<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Web\Controller; use Illuminate\Routing\Controller; use ModStart\App\Web\Layout\WebPage; use ModStart\Core\Exception\BizException; use ModStart\Core\Input\InputPackage; use ModStart\Form\Form; use Module\Vendor\Provider\ContentVerify\ContentVerifyProvider; class ContentVerifyController extends Controller { public function index(WebPage $QDBmO, $Fbuvw) { goto YR6xb; AaTjT: $e1tw_ = InputPackage::buildFromInputJson('param')->all(); goto PSwt1; PSwt1: $y31_Y = Form::make(''); goto XToLZ; ps4xT: if (null !== $ZY4Vx) { return $ZY4Vx; } goto xFLFJ; xFLFJ: return view('module::Vendor.View.contentVerify.index', array('content' => $y31_Y->render(), 'pageTitle' => '审核 · ' . $b8TzI->title())); goto gBU45; Daau3: BizException::throwsIfEmpty('数据异常', $b8TzI); goto AaTjT; XToLZ: $ZY4Vx = $b8TzI->buildForm($y31_Y, $e1tw_); goto ps4xT; YR6xb: $b8TzI = ContentVerifyProvider::get($Fbuvw); goto Daau3; gBU45: } }