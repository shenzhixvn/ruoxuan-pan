<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Shell; use Symfony\Component\Console\Command\Command; use Symfony\Component\Console\Input\InputInterface; use Symfony\Component\Console\Output\OutputInterface; class ClosureCommand extends Command { protected $callback; public function __construct($IntIh, \Closure $hiZ1n) { goto xkgGe; xkgGe: $this->callback = $hiZ1n; goto A0FDF; e9U1y: parent::__construct(); goto Gtq7_; A0FDF: $this->signature = $IntIh; goto e9U1y; Gtq7_: } protected function execute(InputInterface $bCc5F, OutputInterface $wbwAn) { goto uWv6_; uWv6_: $eICRC = array_merge($bCc5F->getArguments(), $bCc5F->getOptions()); goto rc9jH; DIC4m: return $this->laravel->call($this->callback->bindTo($this, $this), $zv6Ur); goto ir2PB; rc9jH: $zv6Ur = array(); goto BWwbg; BWwbg: foreach ((new \ReflectionFunction($this->callback))->getParameters() as $iwnya) { if (isset($eICRC[$iwnya->name])) { $zv6Ur[$iwnya->name] = $eICRC[$iwnya->name]; } } goto DIC4m; ir2PB: } public function describe($NFZNg) { $this->setDescription($NFZNg); return $this; } }