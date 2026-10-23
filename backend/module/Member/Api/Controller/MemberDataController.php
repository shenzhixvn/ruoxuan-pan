<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Api\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Auth\Admin; use ModStart\Data\FileManager; use ModStart\Data\UeditorManager; use Module\Member\Auth\MemberUser; use Module\Member\Support\MemberLoginCheck; class MemberDataController extends Controller implements MemberLoginCheck { public function fileManager($bwyZt) { return FileManager::handle($bwyZt, 'member_upload', 'member_upload_category', MemberUser::id()); } }