<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberMoneyCash extends Migration { public function up() { Schema::create('member_money_cash', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('memberUserId')->nullable()->comment('用户ID'); $ln7i8->tinyInteger('status')->nullable()->comment('状态'); $ln7i8->decimal('money', 20, 2)->nullable()->comment('金额'); $ln7i8->decimal('moneyAfterTax', 20, 2)->nullable()->comment('实际到账'); $ln7i8->string('remark', 100)->nullable()->comment('备注'); $ln7i8->tinyInteger('type')->nullable()->comment('提现账号类型'); $ln7i8->string('realname', 50)->nullable()->comment('提现账号姓名'); $ln7i8->string('account', 200)->nullable()->comment('提现账号'); $ln7i8->index(array('memberUserId')); }); } public function down() { } }