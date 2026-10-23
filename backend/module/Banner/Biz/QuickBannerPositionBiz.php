<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Banner\Biz; class QuickBannerPositionBiz extends AbstractBannerPositionBiz { protected $name; protected $title; public static function make($Fbuvw, $r3C0p) { goto GGLdN; GGLdN: $d0kmE = new static(); goto LK08L; LK08L: $d0kmE->name = $Fbuvw; goto Ybla5; Ybla5: $d0kmE->title = $r3C0p; goto U1sYh; U1sYh: return $d0kmE; goto o02jz; o02jz: } public function name() { return $this->name; } public function title() { return $this->title; } }