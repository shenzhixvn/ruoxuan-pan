<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Provider; use Module\Member\Provider\MemberAdminShowPanel\AbstractMemberAdminShowPanelProvider; class PanMemberAdminShowPanelProvider extends AbstractMemberAdminShowPanelProvider { public function name() { return 'pan'; } public function title() { return '网盘'; } public function renderView() { return 'module::Pan.View.admin.memberAdminShowPanel'; } }