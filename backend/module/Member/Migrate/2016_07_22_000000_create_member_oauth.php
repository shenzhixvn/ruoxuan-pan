<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberOauth extends Migration { public function up() { Schema::create('member_oauth', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('memberUserId')->comment('用户ID')->nullable(); $ln7i8->string('type', 30)->comment('类型')->nullable(); $ln7i8->string('openId', 150)->comment('OpenId')->nullable(); $ln7i8->index(array('type', 'openId')); $ln7i8->index(array('memberUserId')); }); } public function down() { } }