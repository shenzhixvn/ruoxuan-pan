<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Api\Controller; use Illuminate\Routing\Controller; use ModStart\Core\Input\Response; use Module\Member\Auth\MemberUser; use Module\Member\Support\MemberLoginCheck; use Module\Pan\Util\DiskMemberUtil; class DiskInfoController extends Controller implements MemberLoginCheck { public function index() { goto Zv5Ge; FDyE3: $vEwoS = DiskMemberUtil::info($jncMx); goto xJA7Q; Zv5Ge: $jncMx = MemberUser::user(); goto FDyE3; xJA7Q: return Response::generateSuccessData($vEwoS); goto yD8w8; yD8w8: } }