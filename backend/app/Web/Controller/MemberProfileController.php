<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Web\Controller; use ModStart\App\Web\Layout\WebConfigBuilder; use ModStart\Form\Form; use Module\Member\Auth\MemberUser; use Module\Member\Support\MemberLoginCheck; use Module\Member\Type\Gender; use Module\Member\Web\Controller\MemberFrameController; class MemberProfileController extends MemberFrameController implements MemberLoginCheck { private $api; public function __construct() { parent::__construct(); $this->api = app(\App\Api\Controller\MemberProfileController::class); } public function index(WebConfigBuilder $uQwTG) { goto DKlGc; BmxEl: $uQwTG->textarea('signature', '签名'); goto tPw9r; k7pHv: $uQwTG->radio('gender', '性别')->optionType(Gender::class); goto BmxEl; tPw9r: return $uQwTG->perform(MemberUser::user(), function (Form $KuS9v) { return $this->api->basic($KuS9v->dataForming()); }); goto A150m; h7dqh: $uQwTG->text('username', '用户名')->readonly(true); goto k7pHv; DKlGc: $uQwTG->pageTitle('基本资料'); goto xoDp7; xoDp7: $uQwTG->page()->view($this->viewMemberFrame); goto h7dqh; A150m: } }