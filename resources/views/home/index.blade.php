@extends('layouts.app')

@section('content')
<div id="app"></div>
<script>
    window.Laravel = {!! json_encode([
        'appName' => env('APP_NAME'),
        'apiToken' => Auth::user()->api_token ?? null
    ]) !!};
</script>
<script src="{{ mix('js/app.js') }}" defer></script>
@endsection
