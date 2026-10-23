<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use ModStart\Core\Util\EnvUtil; use ModStart\Core\Util\FileUtil; goto X7BIi; G1qr0: if (file_exists(APP_PATH . '/storage/install.lock')) { ?>
        <div class="ub-alert ub-alert-danger ub-text-center">系统无需重复安装</div>
    <?php  } else { goto qFEdf; AmFYS: ?>
                            <?php  goto DtcdH; wK4r0: echo htmlspecialchars(get_env_config('db_password')); goto EUKvG; ZRs3a: ?>
"/>
                                </div>
                                <div class="line">
                                    <label class="label"><span class="ub-text-danger">*</span> 数据库名</label>
                                    <input type="text" style="width:100%;" name="db_database"
                                           value="<?php  goto p23MC; RL_0T: if (!defined('LICENSE_URL')) { echo 'active'; } goto dbfcx; EAIFv: echo INSTALL_APP_NAME . ' V' . INSTALL_APP_VERSION; goto Ik7hC; Hm3Al: function_exists('openssl_open') ? text_success('OpenSSL PHP 扩展') : text_error('缺少 OpenSSL PHP 扩展'); goto V5CFV; oMe6C: if (defined('LICENSE_URL')) { ?>
                    <a href="javascript:;" class="active" data-step="license">
                        <i class="iconfont icon-file"></i>
                        安装协议
                    </a>
                    <i class="iconfont icon-angle-right"></i>
                <?php  } goto tM2hs; ViFBi: ?>
"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-item-foot">
                        <?php  goto P6_be; zitB3: if (version_compare(PHP_VERSION, '5.6.0', 'ge') && version_compare(PHP_VERSION, '5.7.0', 'lt')) { goto cYF95; iVTS5: ?>
                            <?php  goto f_lPy; Nn19N: EnvUtil::iniFileConfig('always_populate_raw_post_data') == '-1' ? text_success('验证 always_populate_raw_post_data=-1') : text_error('请配置 always_populate_raw_post_data=-1', 'https://modstart.com/doc/install/qa.html'); goto iVTS5; cYF95: ?>
                                <?php  goto Nn19N; f_lPy: } goto uoxgS; veGJ8: echo htmlspecialchars(get_env_config('admin_password')); goto ViFBi; p23MC: echo htmlspecialchars(get_env_config('db_name')); goto nVoe1; GwrF_: ?>
</div>
                                <div class="status error ub-alert ub-alert-warning" style="display:none;">
                                    <div>- 配置Nginx/Apache，保证访问 <a href="/install/ping" target="_blank">/install/ping</a> 出现 ok 字样。</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-item-foot">
                        <?php  goto BKDmn; S1K4t: echo htmlspecialchars(json_encode(isset($e1Mq3) ? $e1Mq3 : null)); goto tc1Tr; G6GyO: ?>
                            <?php  goto vF8oo; uywrm: ?>
                            <?php  goto d1LQa; P6_be: if (defined('DEMO_DATA')) { ?>
                            <div>
                                <label style="border:none;margin-top:-10px;">
                                    <input type="checkbox" style="vertical-align:middle;" name="installDemo" value="1"/>
                                    初始化安装演示数据
                                </label>
                            </div>
                        <?php  } goto MLgFb; MLgFb: ?>
                        <div style="margin-top:0.5rem;">
                            <input type="hidden" name="installLicense" value="1"/>
                            <input type="hidden" name="INSTALL_CONFIG" value="<?php  goto S1K4t; ZlXTJ: text_success('Rewrite规则正确'); goto gtJ_h; B4Csu: ?>
                    </div>
                </div>
                <div class="step-content-item ub-form" data-step="form">
                    <div class="content-item-body">
                        <div class="ub-panel" style="background:#F8F8F8;">
                            <div class="head">
                                <div class="title">
                                    <i class="iconfont icon-credit"></i>
                                    MySQL数据库
                                </div>
                            </div>
                            <div class="body">
                                <div class="line">
                                    <label class="label"><span class="ub-text-danger">*</span> 主机</label>
                                    <input type="text" style="width:100%;" name="db_host"
                                           value="<?php  goto FMMP8; oLqJ1: if (!empty($e1Mq3)) { goto aJiE7; aJiE7: ?>
                            <div class="ub-panel" style="background:#F8F8F8;">
                                <div class="head">
                                    <div class="title">
                                        <i class="iconfont icon-cog"></i>
                                        应用配置信息
                                    </div>
                                </div>
                                <div class="body">
                                    <?php  goto br180; QxVfC: ?>
                                </div>
                            </div>
                        <?php  goto Y1ZxO; br180: if (!empty($e1Mq3['envs'])) { goto WKPy0; XzBEQ: foreach ($e1Mq3['envs'] as $MlFSE) { goto oOCm9; pl9qM: echo $MlFSE['name']; goto xmdzh; oOCm9: ?>
                                            <div class="line">
                                                <div class="label"><span class="ub-text-danger">*</span> <?php  goto cysz_; cysz_: echo htmlspecialchars($MlFSE['label']); goto prNbh; YxK4J: ?>
" />
                                                    <div class="help"><?php  goto RL5SJ; SbNwY: echo htmlspecialchars($MlFSE['default']); goto YxK4J; prNbh: ?>
</div>
                                                <div class="field">
                                                    <input class="form" type="text" name="<?php  goto pl9qM; RL5SJ: echo $MlFSE['desc']; goto Kbyil; Kbyil: ?>
</div>
                                                </div>
                                            </div>
                                        <?php  goto C1LBG; xmdzh: ?>
" value="<?php  goto SbNwY; C1LBG: } goto zw8gd; zw8gd: ?>
                                    <?php  goto atFtD; WKPy0: ?>
                                        <?php  goto XzBEQ; atFtD: } goto QxVfC; Y1ZxO: } goto yMpB6; vCAWy: if (!defined('LICENSE_URL')) { echo 'active'; } goto aHFy0; ajaK1: is_dir_really_writable(APP_PATH . '/storage/') ? text_success('/storage/目录可写') : text_error('/storage/目录不可写'); goto DU4QJ; FMMP8: echo htmlspecialchars(get_env_config('db_host')); goto ZRs3a; yMpB6: ?>
                        <div class="ub-panel" style="background:#F8F8F8;">
                            <div class="head">
                                <div class="title">
                                    <i class="iconfont icon-user-o"></i>
                                    后台管理信息
                                </div>
                            </div>
                            <div class="body">
                                <div class="line">
                                    <label class="label"><span class="ub-text-danger">*</span> 用户</label>
                                    <input type="text" style="width:100%;" name="username"
                                           value="<?php  goto Cc7k7; wlkWX: is_dir_really_writable(APP_PATH . '/bootstrap/') ? text_success('/bootstrap/目录可写') : text_error('/bootstrap/目录不可写'); goto hk7gw; B7Ez_: ?>
                <div class="step-content-item <?php  goto RL_0T; Rd8Tm: is_dir_really_writable(APP_PATH . '/public/') ? text_success('/public/目录可写') : text_error('/public/目录不可写'); goto UzR6r; vAAEH: is_dir_really_writable(APP_PATH . '/bootstrap/cache/') ? text_success('/bootstrap/cache/目录可写') : text_error('/bootstrap/cache/目录不可写'); goto N1rAk; wFcLQ: ?>
                            <?php  goto T0wfo; vF8oo: function_exists('mb_internal_encoding') ? text_success('缺少 Mbstring PHP 扩展') : text_error('Mbstring PHP 扩展'); goto MleXn; eMuXd: text_error('Rewrite规则错误', 'https://modstart.com/doc/install/qa.html#q-rewrite%E8%A7%84%E5%88%99', false); goto GwrF_; hUofP: ?>
                            <?php  goto i2LQM; hk7gw: ?>
                            <?php  goto ajaK1; h_WrS: echo htmlspecialchars(get_env_config('db_prefix')); goto ALmsr; bA2tm: function_exists('bcmul') ? text_success('bcmath 扩展') : text_error('缺少 PHP bcmath 扩展'); goto hUofP; VHOiE: ?>
                            <?php  goto Hm3Al; DATfZ: ?>
                            <?php  goto ys8kw; N1rAk: ?>
                            <div data-rewrite-check>
                                <div class="status loading"><div class="ub-alert">Rewrite规则检测中...</div></div>
                                <div class="status success" style="display:none;"><?php  goto ZlXTJ; aHFy0: ?>
" data-step="env">
                    <i class="iconfont icon-desktop"></i>
                    环境检查
                </a>
                <i class="iconfont icon-angle-right"></i>
                <a href="javascript:;" data-step="form">
                    <i class="iconfont icon-cog"></i>
                    配置安装
                </a>
            </div>
            <div class="step-content">
                <?php  goto d6Dsd; idHrY: ?>
                            <?php  goto zitB3; i2LQM: class_exists('pdo') ? text_success('PDO PHP 扩展') : text_error('缺少 PDO PHP 扩展'); goto DATfZ; dbfcx: ?>
" data-step="env">
                    <div class="content-item-body">
                        <div style="margin:0 auto;">
                            <?php  goto oRaDl; MleXn: ?>
                            <?php  goto NZCiH; soNCQ: ?>
                            <?php  goto FfGKu; r3WWL: ?>
"/>
                                </div>
                                <div class="line">
                                    <label class="label"><span class="ub-text-danger">*</span> 密码</label>
                                    <input type="text" style="width:100%;" name="password"
                                           placeholder="<?php  goto veGJ8; sU1WI: ?>
"/>
                                </div>
                                <div class="line">
                                    <label class="label"><span class="ub-text-danger">*</span> 密码</label>
                                    <input type="text" style="width:100%;" name="db_password"
                                           value="<?php  goto wK4r0; gtJ_h: ?>
</div>
                                <div class="status error" style="display:none;"><?php  goto eMuXd; FfGKu: function_exists('proc_open') ? text_success('proc_open 函数') : text_error('缺少 proc_open 函数', 'https://modstart.com/doc/install/qa.html'); goto wFcLQ; mCIv9: ?>
                            <?php  goto rGS1T; uoxgS: ?>
                            <?php  goto wlkWX; EUKvG: ?>
"/>
                                </div>
                                <div class="line">
                                    <label class="label">数据表前缀</label>
                                    <input type="text" style="width:100%;" name="db_prefix"
                                           value="<?php  goto h_WrS; tc1Tr: ?>
" />
                            <a href="javascript:;" onclick="switch_step('env')" class="btn btn-lg btn-round">
                                上一步
                            </a>
                            <a href="javascript:;" onclick="doSubmit();" class="btn btn-primary btn-lg btn-round">
                                确定安装
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php  goto eIjav; iXBqA: function_exists('proc_get_status') ? text_success('proc_get_status 函数') : text_error('缺少 proc_get_status 函数', 'https://modstart.com/doc/install/qa.html'); goto MC2sj; rGS1T: text_success('最大上传：' . FileUtil::formatByte(EnvUtil::env('uploadMaxSize'))); goto VHOiE; DtcdH: php_version_ok() ? text_success('PHP版本 ' . PHP_VERSION) : text_error('PHP版本要求（' . php_version_requires() . '） 当前为 ' . PHP_VERSION); goto mCIv9; d1LQa: function_exists('finfo_file') ? text_success('缺少 PHP Fileinfo 扩展') : text_error('PHP Fileinfo 扩展'); goto idHrY; ys8kw: class_exists('pdo') && in_array('mysql', PDO::getAvailableDrivers()) ? text_success('PDO Mysql 驱动正常') : text_error('缺少 PDO Mysql 驱动'); goto G6GyO; DU4QJ: ?>
                            <?php  goto Rd8Tm; qFEdf: ?>
        <h1 class="ub-text-center" style="color:#FFF;">
            <i class="iconfont icon-tools"></i>
            <?php  goto EAIFv; BKDmn: if (error_counter(0) > 0) { goto QWlV0; f9ney: echo error_counter(0); goto qCQ7R; qCQ7R: ?>
 个问题再进行安装</div>
                        <?php  goto UUApJ; QWlV0: ?>
                            <div class="ub-alert ub-alert-danger ub-text-center">请解决以上 <?php  goto f9ney; UUApJ: } else { if (!env_writable()) { ?>
                            <div class="ub-alert ub-alert-danger ub-text-center">/.env文件不可写，请手动配置安装</div>
                        <?php  } else { goto nQ0Jw; nQ0Jw: ?>
                            <div style="display:none;margin-top:0.5rem;" data-step-env-next>
                                <?php  goto Abf9m; Abf9m: if (defined('LICENSE_URL')) { ?>
                                    <a href="javascript:;" class="btn btn-lg btn-round" onclick="switch_step('license')">
                                        上一步
                                    </a>
                                <?php  } goto YVshN; YVshN: ?>
                                <a href="javascript:;" class="btn btn-primary btn-lg btn-round" onclick="switch_step('form')">
                                    下一步
                                </a>
                            </div>
                        <?php  goto Unf1V; Unf1V: } } goto B4Csu; xgw_q: echo htmlspecialchars(get_env_config('db_username')); goto sU1WI; Ik7hC: ?>
 安装
        </h1>
        <div class="pb-installer-box">
            <div class="step-menu">
                <?php  goto oMe6C; d6Dsd: if (defined('LICENSE_URL')) { goto LfmoE; U7uv4: echo LICENSE_URL; goto VqYYu; LfmoE: ?>
                    <div class="step-content-item active" data-step="license">
                        <div class="content-item-body">
                            <iframe src="<?php  goto U7uv4; VqYYu: ?>
"></iframe>
                        </div>
                        <div class="content-item-foot">
                            <div>
                                <label style="border:none;margin-top:-10px;margin-right:0;padding-right:0;">
                                    <input type="checkbox" name="installLicense" style="vertical-align:middle;margin-right:0.2rem;" value="1"/>
                                    我已阅读协议并同意所有内容
                                </label>
                            </div>
                            <div style="margin-top:0.5rem;">
                                <a href="javascript:;" class="btn btn-primary btn-lg btn-round" onclick="doStepEnv()">
                                    下一步
                                </a>
                            </div>
                            <script>
                                function doStepEnv(){
                                    if(!$('[name="installLicense"]').is(':checked')){
                                        window.api.dialog.tipError('请先同意协议');
                                        return false;
                                    }
                                    switch_step('env');
                                    return false;
                                }
                            </script>
                        </div>
                    </div>
                <?php  goto xcVcf; xcVcf: } goto B7Ez_; QD2zO: ?>
                            <?php  goto iXBqA; Cc7k7: echo htmlspecialchars(get_env_config('admin_username')); goto r3WWL; MC2sj: ?>
                            <?php  goto bA2tm; d3BtW: function_exists('exif_read_data') ? text_success('Exif PHP 扩展') : text_error('缺少 Exif PHP 扩展'); goto soNCQ; nVoe1: ?>
"/>
                                </div>
                                <div class="line">
                                    <label class="label"><span class="ub-text-danger">*</span> 用户名</label>
                                    <input type="text" style="width:100%;" name="db_username"
                                           value="<?php  goto xgw_q; UzR6r: ?>
                            <?php  goto vAAEH; ALmsr: ?>
"/>
                                </div>
                            </div>
                        </div>
                        <?php  goto oLqJ1; oRaDl: text_success('系统：' . PHP_OS); goto AmFYS; V5CFV: ?>
                            <?php  goto d3BtW; tM2hs: ?>
                <a href="javascript:;" class="<?php  goto vCAWy; NZCiH: function_exists('token_get_all') ? text_success('缺少 Tokenizer PHP 扩展') : text_error('Tokenizer PHP 扩展'); goto uywrm; T0wfo: function_exists('putenv') ? text_success('putenv 函数') : text_error('缺少 putenv 函数', 'https://modstart.com/doc/install/qa.html'); goto QD2zO; eIjav: } goto cCckX; TjVgV: ?>
 安装助手</title>
    <style type="text/css">
        body, html {
            min-height: 100%;
        }
        body {
            background-image:url("data:image/svg+xml;base64,<?php  goto isARO; isARO: echo base64_encode('<?xml version="1.0" encoding="UTF-8"?><svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><text x="50%" y="50%" font-size="16" fill="#444444" style="transform:rotate(-45deg);transform-origin:center;" font-family="system-ui,sans-serif" text-anchor="middle" dominant-baseline="middle">' . INSTALL_APP_NAME . ' V' . INSTALL_APP_VERSION . '</text></svg>'); goto e_cH4; azC8T: ?>
");
            background-color:#FFF;
            border-radius:0.5rem;
        }
        .pb-installer-box .step-menu{
            padding:0 0.5rem;
            text-align: center;
            border-bottom:1px solid #EEE;
        }
        .pb-installer-box .step-menu a{
            display:inline-block;
            padding:0.8rem;
            color:var(--color-text);
            text-align:center;
            border-bottom:1px solid #EEE;
            font-size:0.8rem;
        }
        .pb-installer-box .step-menu > .iconfont{
            color:var(--color-muted);
            font-size:0.8rem;
        }
        .pb-installer-box .step-menu a.checked{
            color:var(--color-primary);
        }
        .pb-installer-box .step-menu a.active{
            color:var(--color-primary);
        }
        .pb-installer-box .step-content .step-content-item{
            display:none;
        }
        .pb-installer-box .step-content .step-content-item.active{
            display:block;
        }
        .pb-installer-box .step-content .step-content-item .content-item-body{
            padding:1rem;
        }
        .pb-installer-box .step-content .step-content-item .content-item-foot{
            padding: 1rem 1rem 2rem 1rem;
            text-align:center;
        }
        .pb-installer-box .step-content .step-content-item iframe{
            width:100%;
            border:1px solid #EEE;
            border-radius:0.25rem;
            height:calc( 100vh - 200px );
        }
    </style>
</head>
<body style="background-color:#333;padding:40px 0;">
<div style="width:960px;min-height:100vh;margin:0 auto;">

    <?php  goto G1qr0; npUT7: echo base64_encode('<?xml version="1.0" encoding="UTF-8"?><svg width="100" height="100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><text x="50%" y="50%" font-size="10" fill="#EEEEEE" style="transform:rotate(-45deg);transform-origin:center;" font-family="system-ui,sans-serif" text-anchor="middle" dominant-baseline="middle">' . INSTALL_APP_NAME . ' V' . INSTALL_APP_VERSION . '</text></svg>'); goto azC8T; X7BIi: include __DIR__ . '/function.php'; goto cqPmP; jyHNE: echo INSTALL_APP_NAME . ' V' . INSTALL_APP_VERSION; goto TjVgV; e_cH4: ?>
");
        }
        .pb-installer-box{
            background-image:url("data:image/svg+xml;base64,<?php  goto npUT7; cqPmP: ?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <script src="/asset/vendor/jquery.js"></script>
    <script src="/asset/common/base.js"></script>
    <script src="/asset/layui/layui.js"></script>
    <link rel="stylesheet" href="/asset/vendor/iconfont/iconfont.css">
    <link rel="stylesheet" href="/asset/layui/css/layui.css">
    <link rel="stylesheet" href="/asset/theme/default/style.css">
    <title><?php  goto jyHNE; cCckX: ?>
</div>
<script>
    function switch_step(name){
        $('.pb-installer-box .step-content .step-content-item').removeClass('active');
        $('.pb-installer-box .step-content .step-content-item[data-step='+name+']').addClass('active');
        $('.pb-installer-box .step-menu a').removeClass('active');
        $('.pb-installer-box .step-menu a[data-step='+name+']').addClass('active');
        return false;
    }
    $(function () {
        var $rewriteCheck = $('[data-rewrite-check]');
        $.ajax({
            url: '/install/ping',
            type: 'GET',
            success: function(data){
                if('ok'===data){
                    $rewriteCheck.find('.status').hide().filter('.success').show();
                    $('[data-step-env-next]').show();
                }else{
                    $rewriteCheck.find('.status').hide().filter('.error').show();
                }
            },
            error: function(data) {
                $rewriteCheck.find('.status').hide().filter('.error').show();
            }
        });
        window.doSubmit = function(){
            var data = {};
            var $form = $('.ub-form');
            $form.find('input[type=text],input[type=hidden]').each(function(i,o){
                data[$(o).attr('name')] = $(o).val();
            });
            $form.find('input[type=checkbox]:checked').each(function(i,o){
                data[$(o).attr('name')] = $(o).val();
            });
            window.api.dialog.loadingOn('正在提交表单..');
            window.api.base.post('/install/prepare',data,function(res){
                window.api.dialog.loadingOff();
                window.api.base.defaultFormCallback(res, {
                    success: function (res) {
                        window.api.dialog.loadingOn('正在安装系统，可能需要较长时间，请耐心等待...');
                        window.api.base.post('/install/execute',data,function(res){
                            window.api.dialog.loadingOff();
                            window.api.base.defaultFormCallback(res);
                        });
                    }
                })
            });
            return false;
        };
    });
</script>
</body>
</html>