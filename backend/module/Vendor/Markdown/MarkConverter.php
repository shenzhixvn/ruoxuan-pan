<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Markdown; use League\CommonMark\CommonMarkConverter; use League\CommonMark\Environment; use Webuni\CommonMark\TableExtension\TableExtension; class MarkConverter extends CommonMarkConverter { public function __construct(array $OmAt8 = array(), Environment $R3TBM = null) { goto INzkN; C2sni: parent::__construct($OmAt8, $R3TBM); goto ooM2U; INzkN: $R3TBM = Environment::createCommonMarkEnvironment(); goto lq8aW; lq8aW: $R3TBM->addExtension(new TableExtension()); goto C2sni; ooM2U: } }