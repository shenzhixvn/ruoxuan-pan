<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Util; use ModStart\Core\Exception\BizException; use ModStart\Core\Input\Request; use ModStart\Core\Util\RandomUtil; class NoneLoginOperateUtil { public static function generateUrl($a1OPB, $e1tw_ = array()) { goto oV2IY; oV2IY: $WODUf = array(); goto b4kKF; er0Md: $WODUf['param'] = json_encode($e1tw_); goto x1pey; x1pey: $WODUf['sign'] = self::sign($a1OPB, $WODUf['nonce'], $WODUf['timestamp'], $WODUf['param']); goto DvyJ9; b4kKF: $WODUf['timestamp'] = time(); goto E1CL7; DvyJ9: return Request::domainUrl() . modstart_web_url($a1OPB, $WODUf); goto AvJ5s; E1CL7: $WODUf['nonce'] = RandomUtil::string(10); goto er0Md; AvJ5s: } public static function sign($a1OPB, $yrYxY, $OB4R9, $e1tw_) { goto xsahK; xsahK: $Ujk6Z = config('env.APP_KEY'); goto Esggg; euDhQ: return md5($a1OPB . ':' . $Ujk6Z . ':' . $yrYxY . ':' . $OB4R9 . ':' . $e1tw_); goto KtlY9; Esggg: BizException::throwsIfEmpty('APP_KEY为空', $Ujk6Z); goto euDhQ; KtlY9: } }