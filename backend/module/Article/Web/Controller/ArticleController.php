<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Article\Web\Controller; use ModStart\Core\Input\Response; use ModStart\Core\Util\ArrayUtil; use ModStart\Module\ModuleBaseController; use Module\Article\Util\ArticleUtil; class ArticleController extends ModuleBaseController { public function views($wPLdk) { goto jBkfV; H3Vqs: if ($kCs23['position'] == 'page' || empty($kCs23['position'])) { $ye7R5 = 'article.viewPage'; } goto Qa1CQ; vIUFa: if (empty($kCs23)) { return Response::page404(); } goto aW0am; Qa1CQ: return $this->view($ye7R5, array('article' => $kCs23)); goto PYqID; jBkfV: if (is_numeric($wPLdk)) { $kCs23 = ArticleUtil::get($wPLdk); } else { $kCs23 = ArticleUtil::getByAlias($wPLdk); } goto vIUFa; aW0am: $ye7R5 = 'article.view'; goto H3Vqs; PYqID: } }