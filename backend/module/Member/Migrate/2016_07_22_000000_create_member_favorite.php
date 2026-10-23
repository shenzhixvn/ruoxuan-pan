<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberFavorite extends Migration { public function up() { Schema::create('member_favorite', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('userId')->comment('用户ID')->nullable(); $ln7i8->string('category', 20)->comment('类别')->nullable(); $ln7i8->integer('categoryId')->comment('所属类别ID')->nullable(); $ln7i8->index(array('userId', 'category')); }); } public function down() { } }