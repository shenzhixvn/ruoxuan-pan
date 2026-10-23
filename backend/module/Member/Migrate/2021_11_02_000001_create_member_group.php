<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberGroup extends Migration { public function up() { goto isbx1; bGBx0: \ModStart\Core\Dao\ModelUtil::insertAll('member_group', array(array('title' => '普通用户', 'description' => '', 'isDefault' => true), array('title' => '高级用户', 'description' => '', 'isDefault' => false))); goto s5bdD; isbx1: Schema::create('member_group', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->string('title', 50)->nullable()->comment('名称'); $ln7i8->string('description', 200)->nullable()->comment('描述'); $ln7i8->tinyInteger('isDefault')->nullable()->comment('默认'); }); goto NEgCc; NEgCc: Schema::table('member_user', function (Blueprint $ln7i8) { $ln7i8->integer('groupId')->nullable()->comment(''); }); goto bGBx0; s5bdD: } public function down() { } }