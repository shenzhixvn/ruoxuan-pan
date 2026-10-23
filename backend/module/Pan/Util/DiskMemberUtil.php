<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Util; use ModStart\Core\Dao\ModelUtil; use Module\Member\Util\MemberUtil; class DiskMemberUtil { public static function info($jncMx) { goto TLDRQ; zndgs: return $ZY4Vx; goto fXrRB; TLDRQ: $ZY4Vx = array('panSizeLimit' => 0, 'panSizeUsed' => 0); goto xbbB3; xbbB3: if (empty($jncMx)) { return $ZY4Vx; } goto Zkfoz; pImcK: $ZY4Vx['panSizeUsed'] = intval($jncMx['panSizeUsed']); goto zndgs; Zkfoz: if (!empty($jncMx['panSizeLimit'])) { $ZY4Vx['panSizeLimit'] = $jncMx['panSizeLimit']; } else { $ZY4Vx['panSizeLimit'] = intval(modstart_config('Pan_DefaultSizeLimit', 1)) * 1024 * 1024; } goto pImcK; fXrRB: } public static function updateUsed($jncMx) { $s4Q_6 = ModelUtil::sum('pan_member_file', 'size', array('memberUserId' => $jncMx['id'])); MemberUtil::update($jncMx['id'], array('panSizeUsed' => $s4Q_6)); } }