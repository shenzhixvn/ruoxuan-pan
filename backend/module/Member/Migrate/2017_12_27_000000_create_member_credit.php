<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberCredit extends Migration { public function up() { Schema::create('member_credit', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('memberUserId')->nullable()->comment('用户ID'); $ln7i8->integer('total')->nullable()->comment('数量'); $ln7i8->unique(array('memberUserId')); }); } public function down() { } }