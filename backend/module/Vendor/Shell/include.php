<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto ELepq; sq1Q7: function shell_module_path($oZyI7, $befUz) { return join('/', array(rtrim(shell_module_base(), '/'), $oZyI7, $befUz)); } goto zg_OS; weuvE: function shell_throws_if($hQt2Q, $xLjms) { if ($xLjms) { shell_echo_error($hQt2Q); die(-1); } } goto DUFoM; XgaUg: include __DIR__ . '/../../../vendor/modstart/modstart/src/Core/Util/ReUtil.php'; goto yBzA8; nGgFt: function shell_echo_success($hQt2Q) { echo "[32m>>>>> INFO  : {$hQt2Q} [0m\n"; } goto vNK8v; S98xn: function shell_echo_error($hQt2Q) { echo "[31m>>>>> ERROR : {$hQt2Q} [0m\n"; } goto nGgFt; vNK8v: function shell_echo_info($hQt2Q) { echo "[36m>>>>> INFO  : {$hQt2Q} [0m\n"; } goto weuvE; DUFoM: function shell_command_check($y7lJJ) { @exec($y7lJJ, $wbwAn, $ZY4Vx); return $ZY4Vx === 0; } goto pO2ci; ocvt0: function shell_echo_block($hQt2Q) { goto dGWnm; EWiAF: echo '[0m'; goto XMnHt; Fl7fN: echo ' ' . str_repeat('-', 80) . '
'; goto EWiAF; q_2jU: echo sprintf('| %-79s|', $hQt2Q) . '
'; goto Fl7fN; dGWnm: echo '
[33m'; goto I6esW; I6esW: echo ' ' . str_repeat('-', 80) . '
'; goto q_2jU; XMnHt: } goto S98xn; ELepq: include __DIR__ . '/../../../vendor/modstart/modstart/src/Core/Util/PlatformUtil.php'; goto XgaUg; yBzA8: function shell_module_base() { return realpath(__DIR__ . '/../..'); } goto sq1Q7; zg_OS: function shell_ensure_dir($Zv6Pp) { if (!file_exists($Zv6Pp)) { mkdir($Zv6Pp, 493, true); } } goto ocvt0; pO2ci: function shell_file_write($S_mpR, $Zr532) { goto veer0; veer0: $Zv6Pp = dirname($S_mpR); goto x40pK; tLxJl: file_put_contents($S_mpR, $Zr532); goto AoxZf; x40pK: if (!file_exists($Zv6Pp)) { mkdir($Zv6Pp, 493, true); } goto tLxJl; AoxZf: }