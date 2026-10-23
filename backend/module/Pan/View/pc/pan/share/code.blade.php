@extends($_viewFrame)

@section('pageTitleMain')请输入提取码@endsection
@section('pageKeywords')请输入提取码@endsection
@section('pageDescription')请输入提取码@endsection

@section('bodyContent')

    <div style="max-width:400px;margin:100px auto;" class="tw-bg-white tw-rounded tw-py-8">
        <div class="tw-p-4 tw-rounded-lg tw-flex tw-justify-between tw-items-center tw-mb-2">
            <div class="tw-flex">
                <div class="tw-mr-4">
                    <div class="ub-cover-1-1 tw-shadow tw-w-10 tw-h-10 tw-rounded-full" style="background-image:url({{\ModStart\Core\Assets\AssetsUtil::fix($share['_memberUser']['avatar'])}});">
                    </div>
                </div>
                <div>
                    <div class="tw-font-bold tw-text-gray-800">{{$share['_memberUser']['nickname']}}</div>
                    <div class="tw-text-gray-500 tw-text-sm">分享的文件</div>
                </div>
            </div>
{{--            <a href="#" class="btn btn-primary-line btn-round">--}}
{{--                关注--}}
{{--            </a>--}}
        </div>
        <div class="tw-px-4">
            <form action="{{modstart_web_url('pan/s/'.$share['alias'].'/submit_code')}}" method="post" class="ub-form" data-ajax-form>
                <div class="tw-text-center tw-py-2 tw-px-8">
                    请输入提取码
                </div>
                <div class="tw-py-2 tw-px-8">
                    <input type="text" name="code" class="tw-w-full form-lg tw-text-center"/>
                </div>
                <div class="tw-py-2 tw-px-8">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">确定</button>
                </div>
            </form>
        </div>
    </div>

@endsection
