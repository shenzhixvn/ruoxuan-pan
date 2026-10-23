<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Installer\Util; class InstallerUtil { public static function checkForInstallRedirect() { goto Vlu4H; Vlu4H: $Agrt6 = base_path('.env'); goto Uh0kL; Uh0kL: $L0XQb = storage_path('install.lock'); goto I5xLa; I5xLa: if (!file_exists($L0XQb)) { header('Location: ' . modstart_web_url('install.php')); die; } goto zlYEg; zlYEg: } }