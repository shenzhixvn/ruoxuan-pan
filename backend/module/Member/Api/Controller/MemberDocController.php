<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Api\Controller; use Illuminate\Routing\Controller; use ModStart\Core\Exception\BizException; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; class MemberDocController extends Controller { public function get() { goto njqI7; njqI7: $bCc5F = InputPackage::buildFromInput(); goto G6dXO; ArOAP: return Response::generateSuccessData(array('title' => modstart_config('Member_' . ucfirst($XVfYs) . 'Title'), 'content' => modstart_config('Member_' . ucfirst($XVfYs) . 'Content'))); goto GWrsj; G6dXO: $XVfYs = $bCc5F->getTrimString('type'); goto b4ror; b4ror: BizException::throwsIf('类型错误', !in_array($XVfYs, array('agreement', 'privacy'))); goto ArOAP; GWrsj: } }