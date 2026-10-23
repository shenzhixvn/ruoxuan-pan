<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\QuickRun\Crawl; interface BaseQueue { function prepend($Y8Cl2, $e1tw_ = array(), $wPLdk = null); function append($Y8Cl2, $e1tw_ = array(), $wPLdk = null); function exists($wPLdk); function size(); function poll(); }