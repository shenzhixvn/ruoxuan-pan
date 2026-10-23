<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class CreateMemberDeleteTable extends Migration { public function up() { goto mJHVA; mJHVA: Schema::table('member_user', function (Blueprint $ln7i8) { $ln7i8->bigInteger('deleteAtTime')->nullable()->comment('已删除'); $ln7i8->tinyInteger('isDeleted')->nullable()->comment('已删除'); $ln7i8->index(array('deleteAtTime')); }); goto GWR8W; pJD8c: \ModStart\Core\Dao\ModelUtil::updateAll('member_user', array('isDeleted' => false)); goto uqFXa; GWR8W: Schema::create('member_deleted', function (Blueprint $ln7i8) { $ln7i8->increments('id'); $ln7i8->timestamps(); $ln7i8->string('username', 50)->nullable()->comment('用户名'); $ln7i8->string('phone', 20)->nullable()->comment('手机'); $ln7i8->string('email', 200)->nullable()->comment('邮箱'); $ln7i8->text('content')->comment('其他数据'); }); goto pJD8c; uqFXa: } public function down() { } }