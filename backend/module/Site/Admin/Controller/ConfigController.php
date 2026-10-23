<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Site\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Layout\AdminConfigBuilder; use Module\Vendor\Provider\SiteTemplate\SiteTemplateProvider; class ConfigController extends Controller { public function setting(AdminConfigBuilder $xD3VI) { goto p6SI2; z8psN: $xD3VI->text('siteDomain', '网站域名'); goto ypJhf; GJvhW: $xD3VI->textarea('siteDescription', '网站描述'); goto aayr5; O57F4: $xD3VI->color('sitePrimaryColor', '网站主色调'); goto PuYVL; l1uIo: $xD3VI->text('siteSlogan', '网站副标题'); goto z8psN; ypJhf: $xD3VI->text('siteKeywords', '网站关键词'); goto GJvhW; L4kMS: $xD3VI->image('siteLogo', '网站Logo'); goto guf1V; p6SI2: $xD3VI->pageTitle('网站基础配置'); goto L4kMS; aayr5: $xD3VI->text('siteBeian', '备案编号'); goto zyl45; PuYVL: $xD3VI->select('siteTemplate', '网站模板')->options(SiteTemplateProvider::map()); goto MCgiM; guf1V: $xD3VI->text('siteName', '网站名称'); goto l1uIo; zyl45: $xD3VI->image('siteFavIco', '网站ICO'); goto O57F4; MCgiM: return $xD3VI->perform(); goto vXT3G; vXT3G: } }