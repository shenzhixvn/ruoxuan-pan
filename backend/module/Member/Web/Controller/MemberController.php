<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Web\Controller; use ModStart\Admin\Widget\DashboardItemA; use ModStart\App\Web\Layout\WebPage; use ModStart\Layout\Row; use ModStart\Widget\Box; use Module\Member\Config\MemberHomeIcon; use Module\Member\Support\MemberLoginCheck; class MemberController extends MemberFrameController implements MemberLoginCheck { public function index(WebPage $QDBmO) { goto kNSOQ; yGzAp: foreach (MemberHomeIcon::get() as $fxjUa) { $QDBmO->append(Box::make(new Row(function (Row $kyXWS) use($fxjUa) { foreach ($fxjUa['children'] as $QnBcL) { $kyXWS->column(array('md' => 2, '' => 4), DashboardItemA::makeIconTitleLink($QnBcL['icon'], $QnBcL['title'], $QnBcL['url'])); } }), $fxjUa['title'], 'transparent')); } goto u1joj; u1joj: $QDBmO->pageTitle('我的'); goto HqVlo; kNSOQ: list($ye7R5, $F_21U) = $this->viewPaths('member.index'); goto xlmqD; HqVlo: return $QDBmO; goto jIeWG; xlmqD: $QDBmO->view($ye7R5); goto yGzAp; jIeWG: } }