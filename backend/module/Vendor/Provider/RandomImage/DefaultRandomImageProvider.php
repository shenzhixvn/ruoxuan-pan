<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RandomImage; use ModStart\Core\Assets\AssetsUtil; class DefaultRandomImageProvider extends AbstractRandomImageProvider { public function get($e1tw_ = array()) { return array('url' => AssetsUtil::fix('asset/image/none.png'), 'width' => 400, 'height' => 400); } }