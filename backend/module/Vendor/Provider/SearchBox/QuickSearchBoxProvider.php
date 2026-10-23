<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SearchBox; class QuickSearchBoxProvider extends AbstractSearchBoxProvider { protected $name; protected $title; protected $url; protected $order; public static function make($Fbuvw, $r3C0p, $a1OPB, $aGc11 = 1000) { goto bDbkW; e4TCu: $d0kmE->order = $aGc11; goto NOGoT; csrwL: $d0kmE->url = $a1OPB; goto e4TCu; Zl5uj: $d0kmE->title = $r3C0p; goto csrwL; bDbkW: $d0kmE = new static(); goto BxQIM; BxQIM: $d0kmE->name = $Fbuvw; goto Zl5uj; NOGoT: return $d0kmE; goto Bm_bK; Bm_bK: } public function name() { return $this->name; } public function title() { return $this->title; } public function url() { return $this->url; } public function order() { return $this->order; } }