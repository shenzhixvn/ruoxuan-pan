<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class WorkSalary implements BaseType { public static function getList() { goto oRgRn; oRgRn: static $lWvzu = null; goto jU5bL; jU5bL: if (null === $lWvzu) { $lWvzu = array(); foreach (array('2000元以下', '2000-3999元', '4000-5999元', '6000-9999元', '10000-14999元', '15000-19999元', '20000-49999元', '50000元以上') as $nivms) { $lWvzu[$nivms] = $nivms; } } goto juBhJ; juBhJ: return $lWvzu; goto QrnCp; QrnCp: } }