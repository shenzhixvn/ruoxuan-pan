<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Web\Controller; use ModStart\Core\Input\Response; use ModStart\Module\ModuleBaseController; use Module\Member\Support\MemberLoginCheck; class DiskFileController extends ModuleBaseController implements MemberLoginCheck { private $api; public function __construct(\Module\Pan\Api\Controller\DiskFileController $pwKHI) { $this->api = $pwKHI; } public function preview() { goto a_Wr1; gMFsh: $rSQEM = Response::tryGetData($this->api->preview()); goto TTLcA; a_Wr1: $this->shareDialogPageViewFrame(); goto gMFsh; TTLcA: return $this->view('pan.diskFile.preview.default', $rSQEM); goto V3efI; V3efI: } }