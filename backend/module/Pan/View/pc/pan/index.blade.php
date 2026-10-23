@extends($_viewFrame)

@section('pageTitle'){{modstart_config('Pan_HomeSiteName','网盘系统')}}@endsection

@section('bodyContent')

    @if(\ModStart\Module\ModuleManager::isModuleEnabled('Banner'))
        @include('module::Banner.View.pc.public.banner',['position'=>'pan','bannerRatio'=>'2-1'])
    @endif

    <div class="ub-container">
        <div class="ub-content">
            <div class="head">
                <div class="title">简约专业的云盘系统</div>
                <div class="sub-title">成熟的多用户网盘，私有化云盘方案</div>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="item-a">
                            <div class="image">
                                <i class="iconfont icon-tools ub-color-a" style="font-size:3rem;line-height:3rem;"></i>
                            </div>
                            <div class="title">界面简洁舒适</div>
                            <div class="slogan">提供简介大气的界面设计</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="item-a">
                            <div class="image">
                                <i class="iconfont icon-credit ub-color-b" style="font-size:3rem;line-height:3rem;"></i>
                            </div>
                            <div class="title">多存储支持</div>
                            <div class="slogan">支持多种云存储平台</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="item-a">
                            <div class="image">
                                <i class="iconfont icon-refresh ub-color-c" style="font-size:3rem;line-height:3rem;"></i>
                            </div>
                            <div class="title">文件防误删</div>
                            <div class="slogan">回收站机制，防止文件误删操作</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="item-a">
                            <div class="image">
                                <i class="iconfont icon-share ub-color-d" style="font-size:3rem;line-height:3rem;"></i>
                            </div>
                            <div class="title">文件分享</div>
                            <div class="slogan">支持文件、文件夹公开和私密分享</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
