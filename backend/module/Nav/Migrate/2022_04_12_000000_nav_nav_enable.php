<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class NavNavEnable extends Migration { public function up() { Schema::table('nav', function (Blueprint $ln7i8) { $ln7i8->tinyInteger('enable')->nullable()->comment('启用'); }); \ModStart\Core\Dao\ModelUtil::updateAll('nav', array('enable' => true)); } public function down() { } }