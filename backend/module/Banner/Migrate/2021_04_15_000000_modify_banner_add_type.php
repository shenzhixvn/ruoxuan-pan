<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; use ModStart\Core\Dao\ModelUtil; use Module\Banner\Type\BannerType; class ModifyBannerAddType extends Migration { public function up() { Schema::table('banner', function (Blueprint $ln7i8) { $ln7i8->tinyInteger('type')->nullable()->comment(''); if (!\ModStart\Core\Dao\ModelManageUtil::hasTableColumn('banner', 'title')) { $ln7i8->string('title', 100)->nullable()->comment(''); } $ln7i8->string('slogan', 200)->nullable()->comment(''); $ln7i8->string('linkText', 20)->nullable()->comment(''); $ln7i8->tinyInteger('colorReverse')->nullable()->comment(''); }); foreach (ModelUtil::all('banner') as $nivms) { ModelUtil::update('banner', $nivms['id'], array('type' => BannerType::IMAGE)); } } public function down() { } }