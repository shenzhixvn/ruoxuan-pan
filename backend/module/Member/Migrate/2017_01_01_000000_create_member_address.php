<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class CreateMemberAddress extends Migration { public function up() { Schema::create('member_address', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('userId')->nullable()->comment('用户ID'); $ln7i8->string('name', 20)->nullable()->comment('姓名'); $ln7i8->string('phone', 20)->nullable()->comment('手机号'); $ln7i8->string('area', 100)->nullable()->comment('省市地区'); $ln7i8->string('detail', 200)->nullable()->comment('详细地址'); $ln7i8->string('post', 20)->nullable()->comment('邮政编码'); $ln7i8->tinyInteger('isDefault')->nullable()->comment('默认'); $ln7i8->index(array('userId')); }); } public function down() { } }