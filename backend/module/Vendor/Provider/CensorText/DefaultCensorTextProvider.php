<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\CensorText; use ModStart\Core\Input\Response; class DefaultCensorTextProvider extends AbstractCensorTextProvider { public function name() { return 'default'; } public function title() { return '无检测'; } public function verify($Zr532, $e1tw_ = array()) { return Response::generateSuccessData(array('pass' => false)); } }