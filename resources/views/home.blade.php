@extends('layout')
@section('content')
    <div class="row">
        @foreach ($post as $item)
        <div class="col-md-3 mb-2">
            <a class="card card-link" href="{{route('blogposts', ['id' => $item->id])}}">
                <div class="card-header">
                    {{$item->title}}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        @if (strlen($item->content) > 50)
                            {{substr($item->content, 0, 50)}} ...
                        @else
                            {{$item->content}}
                        @endif
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection