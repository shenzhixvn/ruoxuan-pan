<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Web\Controller; use ModStart\Core\Util\FileUtil; use ModStart\Module\ModuleBaseController; use Module\Member\Support\MemberLoginCheck; class DiskController extends ModuleBaseController implements MemberLoginCheck { public function index() { return $this->view('pan.disk.index'); } }