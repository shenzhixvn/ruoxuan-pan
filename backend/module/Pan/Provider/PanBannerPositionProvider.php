<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Provider; use Module\Banner\Provider\AbstractBannerPositionProvider; class PanBannerPositionProvider extends AbstractBannerPositionProvider { public function name() { return 'pan'; } public function title() { return '网盘首页'; } }