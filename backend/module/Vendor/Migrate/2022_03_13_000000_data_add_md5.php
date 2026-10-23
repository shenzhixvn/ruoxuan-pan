<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class DataAddMd5 extends Migration { public function up() { Schema::table('data', function (Blueprint $ln7i8) { $ln7i8->string('md5', 32)->nullable()->comment(''); $ln7i8->index('md5'); }); Schema::table('data_temp', function (Blueprint $ln7i8) { $ln7i8->string('md5', 32)->nullable()->comment(''); $ln7i8->index('md5'); }); } public function down() { } }