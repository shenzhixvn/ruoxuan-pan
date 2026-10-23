<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\IDManager; abstract class AbstractIDManager { public abstract function name(); public abstract function all(); public abstract function add($dDHef); public abstract function remove($dDHef); public abstract function total(); public abstract function paginate($QDBmO, $xpGq5); public abstract function paginateRandom($QDBmO, $xpGq5, $bEHod = 'all', $YfAkQ = 60); public abstract function forgetRandom($bEHod = 'all'); }