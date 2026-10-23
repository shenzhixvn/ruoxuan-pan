<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\QuickRun\Crawl; class ArrayQueue implements BaseQueue { private $data = array(); function prepend($Y8Cl2, $e1tw_ = array(), $wPLdk = null) { array_unshift($this->data, array('id' => $wPLdk, 'handler' => $Y8Cl2, 'param' => $e1tw_)); } function append($Y8Cl2, $e1tw_ = array(), $wPLdk = null) { array_push($this->data, array('id' => $wPLdk, 'handler' => $Y8Cl2, 'param' => $e1tw_)); } function exists($wPLdk) { foreach ($this->data as $nivms) { if ($nivms['id'] == $wPLdk) { return true; } } return false; } function size() { return count($this->data); } function poll() { return array_shift($this->data); } }