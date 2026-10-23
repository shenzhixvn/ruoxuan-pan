<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Auth\AdminPermission; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use Module\Member\Util\MemberUtil; class PanMemberController extends Controller { public static $PermitMethodMap = array('index' => '\\Module\\Member\\Admin\\Controller\\MemberController@index'); public function index() { goto Bf8dq; TEUpy: MemberUtil::update($bCc5F->getInteger('memberUserId'), array('panSizeLimit' => $bCc5F->getInteger('panSizeLimit') * 1024 * 1024)); goto c4eBF; ZmbEZ: $bCc5F = InputPackage::buildFromInput(); goto TEUpy; c4eBF: return Response::generateSuccess('保存成功'); goto ZwlrS; Bf8dq: AdminPermission::demoCheck(); goto ZmbEZ; ZwlrS: } }