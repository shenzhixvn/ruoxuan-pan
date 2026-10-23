@extends($_viewFrame)

@section('footer')@endsection
@section('pageTitleMain')我的网盘@endsection
@section('pageKeywords')我的网盘@endsection
@section('pageDescription')我的网盘@endsection

{!! \ModStart\ModStart::js('asset/common/clipboard.js') !!}
@section('bodyAppend')
    @parent
    <script src="@asset('asset/vendor/vue.js')"></script>
    <script src="@asset('asset/vendor/element-ui/index.js')"></script>
    <script>
        window._data = {};
    </script>
    <script src="@asset('vendor/Pan/entry/disk.js')"></script>
@endsection

@section('bodyContent')
    <div id="app"></div>
@endsection
