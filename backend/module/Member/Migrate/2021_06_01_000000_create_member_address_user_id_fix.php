<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class CreateMemberAddressUserIdFix extends Migration { public function up() { Schema::table('member_address', function (Blueprint $ln7i8) { $ln7i8->renameColumn('userId', 'memberUserId'); }); } public function down() { } }