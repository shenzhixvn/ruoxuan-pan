<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberUploadCategory extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTable('member_upload_category')) { Schema::create('member_upload_category', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->integer('userId')->nullable()->comment('用户ID'); $ln7i8->string('category', 10)->nullable()->comment('大类'); $ln7i8->integer('pid')->nullable()->comment('上级分类'); $ln7i8->integer('sort')->nullable()->comment('排序'); $ln7i8->string('title', 50)->nullable()->comment('名称'); $ln7i8->index(array('userId')); }); } } public function down() { } }