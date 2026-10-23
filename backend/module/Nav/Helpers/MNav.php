<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ class MNav { public static function all($tJ9gP = 'head') { goto Xn70k; Xn70k: $cTRiU = \Module\Nav\Util\NavUtil::listByPositionWithCache($tJ9gP); goto o3h2l; o3h2l: foreach ($cTRiU as $sPOHJ => $tG00J) { $cTRiU[$sPOHJ]['_attr'] = \Module\Nav\Type\NavOpenType::getBlankAttributeFromValue($tG00J); } goto tpN0z; tpN0z: return $cTRiU; goto s3vKI; s3vKI: } }