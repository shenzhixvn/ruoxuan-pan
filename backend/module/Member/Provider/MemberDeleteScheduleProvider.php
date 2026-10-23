<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Provider; use ModStart\Core\Dao\ModelUtil; use Module\Member\Util\MemberUtil; use Module\Vendor\Provider\Schedule\AbstractScheduleProvider; class MemberDeleteScheduleProvider extends AbstractScheduleProvider { public function cron() { return $this->cronEveryMinute(); } public function title() { return '删除申请注销账号的用户'; } public function run() { $cTRiU = ModelUtil::model('member_user')->where('deleteAtTime', '>', 0)->where('deleteAtTime', '<', time())->where(array('isDeleted' => false))->get()->toArray(); foreach ($cTRiU as $aGc11) { MemberUtil::delete($aGc11['id']); } } }