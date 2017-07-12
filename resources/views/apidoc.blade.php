@extends('layouts.app')
@section('content')
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="{{url('/js')}}/preview.js"></script>
    <div class="container">
        <div class="page-header">
            <h1>{{$collectionInfo->title}}</h1>
            <small>{{$collectionInfo->description}}</small>
        </div>
    </div>

    @foreach($apiInfos as $item)
    <div class="container">
        <blockquote>
            <span style="font-size: 24px">{{$item->api_name}}</span>
            <p>{{$item->api_description}}</p>
        </blockquote>
        <p style="font-size: 16px"><span class="label label-info">{{$item->api_method}}</span>&nbsp {{$item->api_url}}</p>

        <br>
        <ul class="nav nav-tabs">
            <li id="{{'request-'.$item->id.'-tab'}}" role="presentation" class="active"><a onclick="{{"switchTab(".$item->id.",'request')"}}"><b>请求</b></a></li>
            <li id="{{'response-'.$item->id.'-tab'}}" role="presentation"><a onclick="{{"switchTab(".$item->id.",'response')"}}"><b>响应</b></a></li>
        </ul>

        <br>

        <div class="panel panel-default">

            <div class="panel-body" id="{{'request-'.$item->id}}">

                @if($item->request_params != null)
                    <h4>&nbsp QueryString</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr><th>名称</th><th>类型</th><th>说明</th></tr>
                        </thead>
                        <tbody>
                        @foreach($item->request_params as $param)
                            <tr><td>{{$param['param_key']}}</td><td>{{$param['param_type']}}</td><td>{{$param['param_description']}}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                @if($item->request_headers != null)
                    <h4>&nbsp Headers</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr><th>名称</th><th>类型</th><th>说明</th></tr>
                        </thead>
                        <tbody>
                        @foreach($item->request_headers as $header)
                            <tr><td>{{$header['header_key']}}</td><td>{{$header['header_type']}}</td><td>{{$header['header_description']}}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                @if($item->request_body != null)
                    <h4>&nbsp Body</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr><th>名称</th><th>类型</th><th>说明</th></tr>
                        </thead>
                        <tbody>
                        @foreach($item->request_body as $body)
                            <tr><td>{{$body['body_key']}}</td><td>{{$body['body_type']}}</td><td>{{$body['body_description']}}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif



                @if($item->request_example != 'null')
                        <h4>&nbsp Example</h4>
                    <pre id="{{'request-example-'.$item->id}}" class="prettyprint lang-js" style="font-size: 14px">{{$item->request_example}}</pre>
                    <script>
                        var content = document.getElementById("{{'request-example-'.$item->id}}").innerHTML;
                        content = JSON.parse(content);
                        document.getElementById("{{'request-example-'.$item->id}}").innerHTML = JSON.stringify(content,null,'    ');
                    </script>
                @endif
            </div>

            <div class="panel-body" id="{{'response-'.$item->id}}" style="display: none;">

                @if($item->response_headers != null)

                    <h4>&nbsp Headers</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr><th>名称</th><th>类型</th><th>说明</th></tr>
                        </thead>
                        <tbody>
                        @foreach($item->response_headers as $header)
                            <tr><td>{{$header['header_key']}}</td><td>{{$header['header_type']}}</td><td>{{$header['header_description']}}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                @if($item->response_body != null)

                    <h4>&nbsp Body</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr><th>名称</th><th>类型</th><th>说明</th></tr>
                        </thead>
                        <tbody>
                        @foreach($item->response_body as $body)
                            <tr><td>{{$body['body_key']}}</td><td>{{$body['body_type']}}</td><td>{{$body['body_description']}}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                    @if($item->response_example != 'null')
                <h4>&nbsp Example</h4>
                <pre id="{{'response-example-'.$item->id}}" class="prettyprint lang-js" style="font-size: 14px">{{$item->response_example}}</pre>
                <script>
                    var content = document.getElementById("{{'response-example-'.$item->id}}").innerHTML;
                    content = JSON.parse(content);
                    document.getElementById("{{'response-example-'.$item->id}}").innerHTML = JSON.stringify(content,null,'    ');
                </script>
                        @endif
            </div>

        </div>

    </div>
    <br>
    @endforeach
@endsection