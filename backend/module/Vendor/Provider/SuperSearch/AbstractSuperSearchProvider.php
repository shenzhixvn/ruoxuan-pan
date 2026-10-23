<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SuperSearch; abstract class AbstractSuperSearchProvider { public abstract function name(); public abstract function title(); public abstract function ping(); public abstract function bucketExists($Fbuvw); public abstract function bucketCreate($Fbuvw, $LpEQf); public abstract function bucketDelete($Fbuvw); public abstract function bucketCount($Fbuvw); public abstract function upsert($Fbuvw, $wPLdk, $rSQEM); public abstract function delete($Fbuvw, $wPLdk); public abstract function get($Fbuvw, $wPLdk); public abstract function search($Fbuvw, $QDBmO, $xpGq5, $aBxfq = array(), $aGc11 = array()); public function ensureBucket($Fbuvw) { if (!$this->bucketExists($Fbuvw)) { $NAiTX = SuperSearchBiz::get($Fbuvw); $this->bucketCreate($Fbuvw, $NAiTX->fields()); } } }