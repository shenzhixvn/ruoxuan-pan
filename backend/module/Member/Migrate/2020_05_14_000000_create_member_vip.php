<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberVip extends Migration { public function up() { Schema::table('member_user', function (Blueprint $ln7i8) { $ln7i8->integer('vipId')->nullable()->comment(''); $ln7i8->date('vipExpire')->nullable()->comment(''); }); Schema::create('member_vip_set', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->string('title', 50)->nullable()->comment('名称'); $ln7i8->string('flag', 50)->nullable()->comment('标识'); $ln7i8->integer('pid')->nullable()->comment('排序'); $ln7i8->integer('sort')->nullable()->comment('排序'); $ln7i8->tinyInteger('isDefault')->nullable()->comment('默认'); $ln7i8->string('icon', 100)->nullable()->comment('图标'); $ln7i8->decimal('price', 20, 2)->nullable()->comment(''); $ln7i8->integer('vipDays')->nullable()->comment(''); $ln7i8->text('content')->nullable()->comment('说明'); }); } public function down() { } }