<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Concern\HasAdminQuickCRUD; use ModStart\Admin\Layout\AdminCRUDBuilder; use ModStart\Grid\GridFilter; use ModStart\Support\Concern\HasFields; class MemberSelectController extends Controller { use HasAdminQuickCRUD; protected function crud(AdminCRUDBuilder $xD3VI) { $xD3VI->init('member_user')->field(function ($xD3VI) { $xD3VI->id('id', 'ID'); $xD3VI->display('created_at', '创建时间'); $xD3VI->image('avatar', '头像'); $xD3VI->text('username', '用户名'); $xD3VI->text('email', '邮箱'); $xD3VI->text('phone', '手机'); })->gridFilter(function (GridFilter $F0FXA) { $F0FXA->eq('id', L('ID')); $F0FXA->like('username', '用户名'); $F0FXA->like('email', '邮箱'); $F0FXA->like('phone', '手机'); })->title('用户管理')->canDelete(false); } }