<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Banner\Api\Controller; use Illuminate\Routing\Controller; use ModStart\Core\Assets\AssetsUtil; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use Module\Banner\Util\BannerUtil; class BannerController extends Controller { public function get() { goto TFcOF; epRkk: $tJ9gP = $bCc5F->getTrimString('position'); goto z6Xj6; D2NAE: foreach ($vT0cL as $y0FoF => $tG00J) { $vT0cL[$y0FoF]['image'] = AssetsUtil::fixFull($tG00J['image']); } goto Mw8bM; TFcOF: $bCc5F = InputPackage::buildFromInput(); goto epRkk; z6Xj6: $vT0cL = BannerUtil::listByPositionWithCache($tJ9gP); goto D2NAE; Mw8bM: return Response::generateSuccessData($vT0cL); goto SLbfu; SLbfu: } }