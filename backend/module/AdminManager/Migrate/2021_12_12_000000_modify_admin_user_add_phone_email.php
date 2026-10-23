<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class ModifyAdminUserAddPhoneEmail extends Migration { public function up() { $b3N_x = config('modstart.admin.database.connection') ?: config('database.default'); Schema::connection($b3N_x)->table('admin_user', function (Blueprint $ln7i8) { $ln7i8->string('phone', 11)->comment('')->nullable(); $ln7i8->string('email', 100)->comment('')->nullable(); $ln7i8->unique('phone'); $ln7i8->unique('email'); }); } public function down() { } }