<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SuperSearch; class QuickSuperSearchBiz extends AbstractSuperSearchBiz { protected $name; protected $title; protected $field; public static function make($Fbuvw, $r3C0p, $gHm4b) { goto LKTV_; LKTV_: $NAiTX = new static(); goto zEEIG; GZVd8: $NAiTX->title = $r3C0p; goto Idi9L; Idi9L: $NAiTX->field = $gHm4b; goto vNMTY; zEEIG: $NAiTX->name = $Fbuvw; goto GZVd8; vNMTY: return $NAiTX; goto sykpv; sykpv: } public function name() { return $this->name; } public function title() { return $this->title; } public function fields() { return $this->field; } }