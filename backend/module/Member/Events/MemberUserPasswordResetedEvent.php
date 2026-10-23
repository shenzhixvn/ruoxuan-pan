<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Events; class MemberUserPasswordResetedEvent { public $memberUserId; public $newPassword; public function __construct($wUd3t, $ENLCI) { $this->memberUserId = $wUd3t; $this->newPassword = $ENLCI; } }