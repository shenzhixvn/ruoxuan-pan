<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberMessage extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTable('member_message')) { Schema::create('member_message', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('userId')->comment('用户ID')->nullable(); $ln7i8->tinyInteger('status')->comment('1未读 2已读')->nullable(); $ln7i8->integer('fromId')->comment('来源用户ID')->nullable(); $ln7i8->string('content', 20000)->comment('消息内容(html)')->nullable(); $ln7i8->index(array('userId', 'status')); }); } } public function down() { } }