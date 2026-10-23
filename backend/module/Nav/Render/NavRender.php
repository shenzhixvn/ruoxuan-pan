<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Render; use Illuminate\Support\Facades\View; class NavRender { public static function position($tJ9gP) { return View::make('module::Nav.View.inc.nav', array('position' => $tJ9gP))->render(); } }