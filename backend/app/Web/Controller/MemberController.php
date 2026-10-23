<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Web\Controller; use ModStart\Core\Input\Response; use Module\Member\Support\MemberLoginCheck; class MemberController extends BaseController implements MemberLoginCheck { public static $memberLoginCheckIgnores = array('show'); public function index() { return Response::redirect(modstart_web_url('member_profile')); } public function show($y27sC) { return Response::redirect(modstart_web_url('note_member/' . $y27sC)); } }