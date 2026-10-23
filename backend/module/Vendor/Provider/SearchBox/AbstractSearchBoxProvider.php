<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SearchBox; abstract class AbstractSearchBoxProvider { public abstract function name(); public abstract function title(); public abstract function url(); public function order() { return 1000; } }