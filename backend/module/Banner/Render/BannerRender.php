<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Banner\Render; use Illuminate\Support\Facades\View; class BannerRender { public static function position($tJ9gP, $qkvZM = '1400x400', $Uzw8q = '5-2', $doKz1 = '1-1', $eWSgn = false) { return View::make('module::Banner.View.pc.public.banner', array('position' => $tJ9gP, 'bannerSize' => $qkvZM, 'bannerRatio' => $Uzw8q, 'mobileBannerRatio' => $doKz1, 'round' => $eWSgn))->render(); } }