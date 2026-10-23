<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class CreatePanFile extends Migration { public function up() { Schema::create('pan_file', function (Blueprint $ln7i8) { $ln7i8->bigIncrements('id'); $ln7i8->timestamps(); $ln7i8->string('url', 200)->nullable()->comment(''); $ln7i8->integer('size')->nullable()->comment(''); $ln7i8->string('hash', 32)->nullable()->comment(''); $ln7i8->integer('useCount')->nullable()->comment(''); $ln7i8->unique(array('hash')); }); } public function down() { } }