<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Banner\Biz; class BannerPosition extends AbstractBannerPositionBiz { private $name; private $title; public static function make($Fbuvw, $r3C0p) { goto qw1GB; TZ6Gm: return $z5hSx; goto eQ2AD; qw1GB: $z5hSx = new static(); goto Gh5yG; T3iwC: $z5hSx->title = $r3C0p; goto TZ6Gm; Gh5yG: $z5hSx->name = $Fbuvw; goto T3iwC; eQ2AD: } public function name() { return $this->name; } public function title() { return $this->title; } }