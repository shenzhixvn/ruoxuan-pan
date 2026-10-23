<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Article\Api\Controller; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use ModStart\Module\ModuleBaseController; use Module\Article\Util\ArticleUtil; class ArticleController extends ModuleBaseController { public function get() { goto Fitva; BekgO: return Response::generateSuccessData(array('article' => $kCs23)); goto Rvs9M; Fitva: $bCc5F = InputPackage::buildFromInput(); goto nUXfc; nUXfc: $wPLdk = $bCc5F->getTrimString('id'); goto yPbdE; yPbdE: if (is_numeric($wPLdk)) { $kCs23 = ArticleUtil::get($wPLdk); } else { $kCs23 = ArticleUtil::getByAlias($wPLdk); } goto BekgO; Rvs9M: } }