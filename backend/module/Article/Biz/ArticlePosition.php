<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Article\Biz; class ArticlePosition extends AbstractArticlePositionBiz { private $name; private $title; public static function make($Fbuvw, $r3C0p) { goto Xox3f; xdTp3: $z5hSx->name = $Fbuvw; goto bj38e; Xox3f: $z5hSx = new static(); goto xdTp3; f3Kwv: return $z5hSx; goto RKLgl; bj38e: $z5hSx->title = $r3C0p; goto f3Kwv; RKLgl: } public function name() { return $this->name; } public function title() { return $this->title; } }