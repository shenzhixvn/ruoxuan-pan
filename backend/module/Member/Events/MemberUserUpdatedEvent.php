<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Events; class MemberUserUpdatedEvent { public $memberUserId; public $type; public function __construct($wUd3t, $XVfYs) { $this->memberUserId = $wUd3t; $this->type = $XVfYs; } }