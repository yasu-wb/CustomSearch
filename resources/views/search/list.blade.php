@extends('layouts.base')
@section('content')

<div class="container-fluid">
    <div>
        総検索数: {{ isset($res->searchInformation) ? $res->searchInformation->totalResults : ''}}
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">タイトル</th>
                <th scope="col">詳細</th>
            </tr>
        </thead>
        <tbody>
            @isset($res->items)
            @foreach($res->items as $item)
            <tr>
                <td><a href="{{ $item->link }}">{{ $item->title }}</a></td>
                <td>{{ $item->snippet }}</td>
            </tr>
            @endforeach
            @endisset
            @if(!isset($res->items))
            <tr>
                <td colspan="3">検索結果がありません</td>
            @endif
        </tbody>
    </table>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4">
                @if(request()->get('start') > 1)
                <a href="{{ url()->full() }}" onclick="event.preventDeefault(); document.getElementById('previous').submit()">前へ</a>
                <form action="{{ url()->current() }}" id="previous">
                    <input type="hidden" name="keyword" value="{{ request()->get('keyword') }}">
                    <input type="hidden" name="search_type" value="{{ request()->get('search_type') }}">
                    <input type="hidden" name="limit" value="{{ request()->get('limit') }}">
                    <input type="hidden" name="start" value="{{ request()->get('start') - 10 }}">
                </form>
                @endif
            </div>
            <div class="col-md-4 offset-md-4">
                @if(request()->get('start') > 1)
                <a href="{{ url()->full() }}" onclick="event.preventDefault();document.getElementById('next').submit()">次へ</a>
                <form action="{{ url()->full() }}" id="next">
                    <input type="hidden" name="keyword" value="{{ request()->get('keyword') }}">
                    <input type="hidden" name="search_type" value="{{ request()->get('search_type') }}">
                    <input type="hidden" name="limit" value="{{ request()->get('limit') }}">
                    <input type="hidden" name="start" value="{{ request()->get('start') + 10 }}">
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

<style lang="scss">

</style>
@endsection
