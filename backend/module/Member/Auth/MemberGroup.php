<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Auth; use Module\Member\Util\MemberGroupUtil; use Module\Member\Util\MemberVipUtil; class MemberGroup { public static function get($nSiYr = null) { goto SFSGh; SFSGh: static $dQHcG = null; goto HIdQm; m5tYW: if (null !== $nSiYr) { return $dQHcG[$nSiYr]; } goto EdJ7p; HIdQm: if (null === $dQHcG) { $dQHcG = MemberGroupUtil::getMemberGroup(MemberUser::user()); } goto m5tYW; EdJ7p: return $dQHcG; goto X80cL; X80cL: } }