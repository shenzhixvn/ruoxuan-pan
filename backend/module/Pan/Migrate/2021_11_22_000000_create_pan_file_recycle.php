<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class CreatePanFileRecycle extends Migration { public function up() { Schema::create('pan_file_recycle', function (Blueprint $ln7i8) { $ln7i8->bigIncrements('id'); $ln7i8->timestamps(); $ln7i8->integer('memberUserId')->nullable()->comment(''); $ln7i8->string('entry', 1000)->nullable()->comment(''); $ln7i8->bigInteger('memberFileId')->nullable()->comment(''); $ln7i8->dateTime('deleteTime')->nullable()->comment(''); $ln7i8->bigInteger('deleteBatchNum')->nullable()->comment(''); $ln7i8->index(array('memberUserId')); $ln7i8->unique(array('deleteBatchNum')); }); } public function down() { } }