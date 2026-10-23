<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Middleware; class StatelessRouteMiddleware { public function handle($eZe1Y, \Closure $qNEDM) { config()->set('session.driver', 'array'); return $qNEDM($eZe1Y); } }