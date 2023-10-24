@extends('layouts.app')

@section('title')
    Проверить MAC-адрес
@endsection

@section('content')
    <h3 class=" mt-2 text-3xl flex sm:text-3xl text-gray-800 dark:text-white font-extrabold tracking-tight">
        Проверить MAC-адрес</h3>

    <div class="mt-3 mr-5">
     <macvendor></macvendor>
    </div>
@endsection
