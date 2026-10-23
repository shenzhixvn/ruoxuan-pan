<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class ModifyMemberOauthAddInfo extends Migration { public function up() { Schema::table('member_oauth', function (Blueprint $ln7i8) { $ln7i8->string('infoUsername', 100)->nullable(); $ln7i8->string('infoAvatar', 200)->nullable(); }); } public function down() { } }