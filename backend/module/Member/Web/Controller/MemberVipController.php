<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Web\Controller; use ModStart\Core\Exception\BizException; use ModStart\Module\ModuleBaseController; use ModStart\Module\ModuleManager; use Module\Member\Support\MemberLoginCheck; use Module\Member\Util\MemberVipUtil; class MemberVipController extends ModuleBaseController { private $api; public function index() { goto ZA8zp; lt5CE: $this->api = app(\Module\Member\Api\Controller\MemberVipController::class); goto ZuOub; ZA8zp: BizException::throwsIf('缺少 PayCenter 模块', !ModuleManager::isModuleEnabled('PayCenter')); goto lt5CE; ZuOub: return $this->view('memberVip.index', array('memberVips' => MemberVipUtil::all())); goto infHU; infHU: } }