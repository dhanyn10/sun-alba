@extends('layout')
@section('content')
    @foreach ($postItem as $item)
    <div class="card">
        <div class="card-header">
            {{$item->title}}
        </div>
        <div class="card-body">
            <div class="card-text">
                {{$item->content}}
            </div>
        </div>
    </div>
    @endforeach
@endsection