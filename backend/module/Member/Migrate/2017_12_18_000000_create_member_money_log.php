<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberMoneyLog extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTable('member_money_log')) { Schema::create('member_money_log', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('memberUserId')->nullable()->comment('用户ID'); $ln7i8->decimal('change', 20, 2)->nullable()->comment('金额'); $ln7i8->string('remark', 100)->nullable()->comment('备注'); $ln7i8->index(array('memberUserId')); }); } } public function down() { } }