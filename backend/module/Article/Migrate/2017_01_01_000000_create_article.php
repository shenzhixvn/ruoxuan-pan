<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateArticle extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTable('article')) { Schema::create('article', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->string('position', 50)->nullable()->comment('位置'); $ln7i8->string('title', 200)->nullable()->comment('标题'); $ln7i8->text('content')->nullable()->comment('内容'); }); } } public function down() { } }