<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Captcha; class CaptchaUtil { public static function get() { goto YGBji; CK281: return $A311f; goto wjAuB; YGBji: static $A311f = null; goto JVRwt; JVRwt: if (null === $A311f) { goto Pgc9B; UuvqV: if (empty($eJ6_5)) { $eJ6_5 = DefaultCaptchaProvider::class; } goto OE8Q2; Pgc9B: $eJ6_5 = config('CaptchaProviderDriver'); goto UuvqV; OE8Q2: $A311f = app($eJ6_5); goto sigpA; sigpA: } goto CK281; wjAuB: } }