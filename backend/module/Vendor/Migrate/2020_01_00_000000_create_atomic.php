<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; use ModStart\Core\Dao\ModelManageUtil; class CreateAtomic extends Migration { public function up() { if (!ModelManageUtil::hasTable('atomic')) { Schema::create('atomic', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->string('name', 100)->nullable()->comment(''); $ln7i8->integer('value')->nullable()->comment(''); $ln7i8->integer('expire')->nullable()->comment(''); $ln7i8->unique('name'); $ln7i8->index('expire'); }); } } public function down() { } }