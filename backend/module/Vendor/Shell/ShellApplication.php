<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Shell; use Illuminate\Console\Application; use Illuminate\Events\Dispatcher; use Symfony\Component\Console\Command\Command; use Symfony\Component\Console\Input\InputInterface; use Symfony\Component\Console\Output\OutputInterface; class ShellApplication extends Application { public function __construct($Fbuvw = 'Console Application', $HLyxF = '1.0.0') { goto VhTE4; CWZNf: $this->setCatchExceptions(true); goto iTikI; VhTE4: parent::__construct($GAhSo = new \Illuminate\Foundation\Application(), new Dispatcher($GAhSo), $HLyxF); goto WjmMk; O4HBn: $this->setAutoExit(true); goto CWZNf; WjmMk: $this->setName($Fbuvw); goto O4HBn; iTikI: } public function command($IntIh, \Closure $hiZ1n, $NFZNg = null) { return $this->add((new ClosureCommand($IntIh, $hiZ1n))->describe($NFZNg)); } public function runAsSingle(InputInterface $bCc5F = null, OutputInterface $wbwAn = null) { foreach ($this->all() as $y7lJJ) { $this->setDefaultCommand($y7lJJ, true); break; } return $this->run($bCc5F, $wbwAn); } }