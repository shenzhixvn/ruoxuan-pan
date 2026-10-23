<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Biz; class NavPosition extends AbstractNavPositionBiz { private $name; private $title; public static function make($Fbuvw, $r3C0p) { goto utrwi; p1bOv: $z5hSx->name = $Fbuvw; goto DqHvq; utrwi: $z5hSx = new static(); goto p1bOv; ZY_8d: return $z5hSx; goto COTlr; DqHvq: $z5hSx->title = $r3C0p; goto ZY_8d; COTlr: } public function name() { return $this->name; } public function title() { return $this->title; } }