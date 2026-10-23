<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Web\Controller; use Module\Pan\Provider\PanHomePageProvider; use Module\Vendor\Installer\Util\InstallerUtil; use Module\Vendor\Provider\HomePage\HomePageProvider; class IndexController extends BaseController { public function index() { InstallerUtil::checkForInstallRedirect(); return HomePageProvider::call(__METHOD__, PanHomePageProvider::ACTION); } }