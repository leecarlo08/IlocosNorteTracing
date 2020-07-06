@extends('layouts.app')

@section('js')
    <script src="{{ asset(mix('js/in-tourist.js')) }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <router-view></router-view>
    </div>
@endsection
