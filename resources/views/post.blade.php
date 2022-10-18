@extends('layout')
@section('content')
    @foreach ($postitem as $item)
    <div class="card">
        <div class="card-header">
            {{$item->title}}
        </div>
        <div class="card-body">
            <div class="card-text">
                {{$item->content}}
            </div>
            <p>
                @foreach ($categories as $item)
                    <span class="badge text-bg-primary">{{$item}}</span>
                @endforeach
            </p>
        </div>
    </div>
    @endforeach
@endsection