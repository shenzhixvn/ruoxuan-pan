<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Type; use ModStart\Core\Type\BaseType; class DiskFileType implements BaseType { private static $buildIn = null; public static function getList() { if (null == self::$buildIn) { self::$buildIn = array('dir' => '文件夹', 'file' => '文件'); } return self::$buildIn; } }