<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberUpload extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTable('member_upload')) { Schema::create('member_upload', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->unsignedInteger('userId')->nullable()->comment('用户ID'); $ln7i8->string('category', 10)->nullable()->comment('大类'); $ln7i8->unsignedInteger('dataId')->nullable()->comment('文件ID'); $ln7i8->integer('uploadCategoryId')->nullable()->comment('分类ID'); $ln7i8->index(array('userId', 'uploadCategoryId')); }); } } public function down() { } }