<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class ModifyMemberUserPan extends Migration { public function up() { Schema::table('member_user', function (Blueprint $ln7i8) { $ln7i8->bigInteger('panSizeLimit')->nullable()->comment(''); $ln7i8->bigInteger('panSizeUsed')->nullable()->comment(''); }); } public function down() { } }