<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class CreatePanShare extends Migration { public function up() { Schema::create('pan_share', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('memberUserId')->nullable()->comment(''); $ln7i8->string('alias', 20)->nullable()->comment(''); $ln7i8->dateTime('shareTime')->nullable()->comment(''); $ln7i8->dateTime('expireTime')->nullable()->comment(''); $ln7i8->string('name', 100)->nullable()->comment(''); $ln7i8->string('code', 10)->nullable()->comment(''); $ln7i8->integer('type')->nullable()->comment(''); $ln7i8->integer('status')->nullable()->comment(''); $ln7i8->string('fileIds', 1000)->nullable()->comment(''); $ln7i8->unique(array('alias')); $ln7i8->index(array('memberUserId')); }); } public function down() { } }