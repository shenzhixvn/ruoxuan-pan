<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Ocr; abstract class AbstractOcrProvider { public abstract function name(); public abstract function title(); public abstract function getText($P_Nk0, $Gy9xp, $e1tw_ = array()); }