<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberVipOrder extends Migration { public function up() { Schema::create('member_vip_order', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('memberUserId')->nullable()->comment('排序'); $ln7i8->integer('vipId')->nullable()->comment(''); $ln7i8->decimal('payFee', 20, 2)->nullable()->comment(''); $ln7i8->tinyInteger('status')->nullable()->comment('默认'); $ln7i8->date('expire')->nullable()->comment(''); $ln7i8->string('type', 20)->nullable()->comment(''); }); } public function down() { } }