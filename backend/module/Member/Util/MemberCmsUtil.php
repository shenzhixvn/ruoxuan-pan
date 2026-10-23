<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Util; use ModStart\Core\Assets\AssetsUtil; use ModStart\Core\Dao\ModelUtil; use ModStart\Field\AutoRenderedFieldValue; class MemberCmsUtil { public static function showFromId($wUd3t) { goto kGPJq; i6HQY: return self::show($jncMx); goto d4CBF; kGPJq: if (!$wUd3t) { return AutoRenderedFieldValue::make('<span class="ub-text-muted">-</span>'); } goto JEd90; JEd90: $jncMx = ModelUtil::getWithCache('member_user', array('id' => $wUd3t)); goto i6HQY; d4CBF: } public static function show($jncMx) { if (!empty($jncMx)) { return AutoRenderedFieldValue::make('<a href="javascript:;" class="ub-icon-text" data-dialog-request="' . action('\\Module\\Member\\Admin\\Controller\\MemberController@show', array('_id' => $jncMx['id'])) . '">
            <img class="icon" src="' . AssetsUtil::fixOrDefault($jncMx['avatar'], 'asset/image/avatar.png') . '" />
            <span class="text">' . htmlspecialchars($jncMx['username']) . '</span></a>'); } return AutoRenderedFieldValue::make(''); } }