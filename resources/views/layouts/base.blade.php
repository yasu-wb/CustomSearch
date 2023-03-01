<!DOCTYPE html>

<html lang="ja" translate="no">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }}</title>
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
  </head>

  <body>

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header d-block">
        <form action="{{ route('search') }}">
        <div class="container text-center">
          <div class="row d-flex">
              <div class="col-8">
                <input name="keyword" class="form-control form-control-lg" type="text" placeholder="検索フォーム" value="{{ request()->get('keyword') }}">
              </div>
              <div class="col">
                <select name="search_type" class="form-select form-select-lg" aria-label="Default select example">
                  <option value="" selected>全て</option>
                  @foreach (App\Enums\SearchType::cases() as $enum)
                  <option value="{{ (string) $enum->value }}" @selected(request()->get('search_type') == $enum->value)>{{ $enum->label() }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col">
                <select name="limit" class="form-select form-select-lg" aria-label="Default select example">
                  @for ($i = 1; $i <= 10; $i++)
                  <option value="{{ $i }}" @selected(request()->get('limit') == $i)>{{ $i }}件</option>
                  @endfor
                </select>
              </div>
              <div class="col">
                <input type="hidden" name="start" value="{{ request()->get('start') ?? 1 }}">
                <button type="submit" class="btn btn-info lg text-white">検索</button>
              </div>
          </div>
        </div>
      </form>
      </header>
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          @yield('content')
        </div>
      </div>
    </div>

    @vite('resources/js/app.js')
    @yield('javascript')
  </body>
</html>
