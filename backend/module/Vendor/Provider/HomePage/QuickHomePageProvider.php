<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\HomePage; class QuickHomePageProvider extends AbstractHomePageProvider { protected $type; protected $title; protected $action; public static function make($r3C0p, $Ujd7M, $XVfYs = array(self::TYPE_PC, self::TYPE_MOBILE)) { goto om3f8; qNnYd: $d0kmE->action = $Ujd7M; goto cvC2z; dxgCa: $d0kmE->title = $r3C0p; goto qNnYd; cvC2z: return $d0kmE; goto oo4EZ; Kbe83: $d0kmE->type = $XVfYs; goto dxgCa; om3f8: $d0kmE = new static(); goto Kbe83; oo4EZ: } public function type() { return $this->type; } public function title() { return $this->title; } public function action() { return $this->action; } }