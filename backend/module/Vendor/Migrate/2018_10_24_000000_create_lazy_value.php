<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateLazyValue extends Migration { public function up() { Schema::create('lazy_value', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->string('key', 50)->nullable()->comment(''); $ln7i8->string('param', 100)->nullable()->comment(''); $ln7i8->integer('expire')->nullable()->comment(''); $ln7i8->integer('lifeExpire')->nullable()->comment(''); $ln7i8->integer('cacheSeconds')->nullable()->comment(''); $ln7i8->text('value')->nullable()->comment(''); $ln7i8->unique(array('key', 'param')); $ln7i8->index(array('expire')); $ln7i8->index(array('lifeExpire')); }); } public function down() { } }