<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class PanPanMemberFileUniqueFix extends Migration { public function up() { Schema::table('pan_member_file', function (Blueprint $ln7i8) { $ln7i8->dropUnique(array('pid', 'fileName')); $ln7i8->unique(array('memberUserId', 'pid', 'fileName')); }); } public function down() { } }