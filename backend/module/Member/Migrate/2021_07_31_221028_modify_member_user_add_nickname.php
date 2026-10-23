<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class ModifyMemberUserAddNickname extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTableColumn('member_user', 'nickname')) { Schema::table('member_user', function (Blueprint $ln7i8) { $ln7i8->string('nickname', 50)->nullable()->comment(''); $ln7i8->index('nickname'); }); } } public function down() { } }