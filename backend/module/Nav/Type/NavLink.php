<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Type; class NavLink { public static function generate($iqVgY, $e1tw_ = array()) { goto UgsHl; CAM3C: if (is_array($iqVgY)) { $iqVgY = isset($iqVgY['link']) ? $iqVgY['link'] : null; } goto dPMJN; fOIYn: return $iqVgY; goto HVefV; UgsHl: if (empty($iqVgY)) { return ''; } goto CAM3C; dPMJN: if (!empty($e1tw_)) { $dBqej = array_map(function ($nivms) { return '{' . $nivms . '}'; }, array_keys($e1tw_)); $iqVgY = str_replace($dBqej, array_values($e1tw_), $iqVgY); } goto fOIYn; HVefV: } }