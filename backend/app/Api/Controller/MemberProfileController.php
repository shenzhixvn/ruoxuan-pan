<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Api\Controller; use Illuminate\Routing\Controller; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use ModStart\Core\Util\ArrayUtil; use Module\Member\Auth\MemberUser; use Module\Member\Support\MemberLoginCheck; use Module\Member\Util\MemberUtil; class MemberProfileController extends Controller implements MemberLoginCheck { public function basic($ALrAj = null) { goto Mx3X7; Ev0po: return Response::jsonSuccess('保存成功'); goto zzmlG; Mx3X7: $R2Tev = InputPackage::buildFromInput(); goto FD_6l; FD_6l: if (null === $ALrAj) { $ALrAj = $R2Tev->all(); } goto qBcV8; qBcV8: MemberUtil::update(MemberUser::id(), ArrayUtil::keepKeys($ALrAj, array('gender', 'realname', 'signature'))); goto Ev0po; zzmlG: } }