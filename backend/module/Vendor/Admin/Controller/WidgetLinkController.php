<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Core\Dao\ModelManageUtil; use ModStart\Core\Dao\ModelUtil; use ModStart\Core\Util\TreeUtil; use ModStart\Module\ModuleManager; use Module\Vendor\Admin\Config\AdminWidgetLink; class WidgetLinkController extends Controller { public static $PermitMethodMap = array('*' => '*'); private function build($v8fKv, $FHmAb) { if (empty($FHmAb)) { return null; } return array('title' => $v8fKv, 'list' => array_filter(array_map(function ($nivms) { return $nivms ? array('title' => $nivms[0], 'link' => $nivms[1]) : null; }, $FHmAb))); } public function select() { goto JtUGG; oelTv: return view('modstart::admin.dialog.linkSelector', array('links' => array_filter($Hpp75))); goto JeMeI; o90i2: $Hpp75[] = $this->build('系统', array(array('首页', modstart_web_url('')))); goto TGaW_; JtUGG: $Hpp75 = array(); goto o90i2; TGaW_: $Hpp75 = array_merge($Hpp75, AdminWidgetLink::get()); goto oelTv; JeMeI: } }