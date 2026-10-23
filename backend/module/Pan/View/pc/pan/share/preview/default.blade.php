@extends($_viewFrameDialog)

@section('pageTitleMain'){{$file['fileName']}}@endsection
@section('pageKeywords'){{$file['fileName']}}@endsection
@section('pageDescription'){{$file['fileName']}}@endsection

@section('bodyContent')
    <div class="ub-panel">
        <div class="head">
        </div>
        <div class="body">
            <div class="ub-empty">
                <div class="icon">
                    <i class="iconfont icon-empty-box"></i>
                </div>
                <div class="text">暂不提供预览</div>
            </div>
        </div>
    </div>
    <div class="tw-bg-white tw-rounded-lg tw-p-4">
        <span class="tw-font-bold">
            <i class="iconfont icon-file"></i>
            {{$file['fileName']}}
        </span>
        <span class="tw-ml-4">
            大小：
            {{\ModStart\Core\Util\FileUtil::formatByte($file['size'])}}
        </span>
        <span class="tw-ml-4">
            <i class="iconfont icon-time"></i>
            上传时间：
            {{$file['uploadTime']}}
        </span>
    </div>
@endsection





