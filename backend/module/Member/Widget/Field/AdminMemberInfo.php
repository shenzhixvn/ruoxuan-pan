<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Widget\Field; use ModStart\Field\AbstractField; use ModStart\Field\Text; use ModStart\Field\Type\FieldRenderMode; use Module\Member\Util\MemberCmsUtil; class AdminMemberInfo extends Text { protected $view = 'modstart::core.field.text'; protected $editable = false; public function renderView(AbstractField $gHm4b, $nivms, $ltyOC = 0) { switch ($gHm4b->renderMode()) { case FieldRenderMode::GRID: case FieldRenderMode::DETAIL: $this->hookRendering(function (AbstractField $gHm4b, $nivms, $ltyOC) { $KZWO6 = $gHm4b->column(); return MemberCmsUtil::showFromId($nivms->{$KZWO6}); }); } return parent::renderView($gHm4b, $nivms, $ltyOC); } }