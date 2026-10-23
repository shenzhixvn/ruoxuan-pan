<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\ContentVerify; use ModStart\Core\Job\BaseJob; class ContentVerifyJob extends BaseJob { public $name; public $title; public $body; public $param; public static function create($Fbuvw, $e1tw_, $r3C0p, $Xv0lU = null) { goto naSn4; naSn4: $gGZWQ = new static(); goto dI949; lDIL2: $gGZWQ->body = $Xv0lU; goto NgPh1; DWTfD: $gGZWQ->param = $e1tw_; goto mnpYI; NgPh1: app('Illuminate\\Contracts\\Bus\\Dispatcher')->dispatch($gGZWQ); goto zuSor; mnpYI: $gGZWQ->title = $r3C0p; goto lDIL2; dI949: $gGZWQ->name = $Fbuvw; goto DWTfD; zuSor: } public function handle() { $b8TzI = ContentVerifyProvider::get($this->name); $b8TzI->run($this->param, $this->title, $this->body); } }