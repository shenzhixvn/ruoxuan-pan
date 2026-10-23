@extends($_viewFrame)

@section('footer')@endsection
@section('pageTitleMain'){{$share['name']}}@endsection
@section('pageKeywords'){{$share['name']}}@endsection
@section('pageDescription'){{$share['name']}}@endsection

{!! \ModStart\ModStart::js('asset/common/clipboard.js') !!}
@section('bodyAppend')
    @parent
    <script src="@asset('asset/vendor/vue.js')"></script>
    <script src="@asset('asset/vendor/element-ui/index.js')"></script>
    <script>
        window.__data = {
            share:{!! json_encode($share) !!},
            memberUserId:{!! json_encode(\Module\Member\Auth\MemberUser::id()) !!},
        };
    </script>
    <script src="@asset('vendor/Pan/entry/share.js')"></script>
@endsection

@section('bodyContent')
    <div id="app"></div>
@endsection
