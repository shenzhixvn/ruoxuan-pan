<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; use ModStart\Core\Dao\ModelManageUtil; class CreateBanner extends Migration { public function up() { if (ModelManageUtil::hasTable('banner')) { goto g8zZI; R6NB8: if (!in_array('position', $PA3Gh)) { Schema::table('banner', function (Blueprint $ln7i8) { $ln7i8->string('position', 50)->nullable()->comment('位置'); }); } goto CgaHr; CgaHr: if (!in_array('sort', $PA3Gh)) { Schema::table('banner', function (Blueprint $ln7i8) { $ln7i8->integer('sort')->nullable()->comment('顺序'); }); } goto xUxvv; g8zZI: $PA3Gh = ModelManageUtil::listTableColumns('banner'); goto R6NB8; xUxvv: } else { Schema::create('banner', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->string('position', 50)->nullable()->comment('位置'); $ln7i8->integer('sort')->nullable()->comment('顺序'); $ln7i8->string('image', 100)->nullable()->comment('图片'); $ln7i8->string('link', 200)->nullable()->comment('链接'); }); } } public function down() { } }