@extends('layouts.app')

@section('title')
    Заказы
@endsection

@section('content')
    <h3 class=" mt-2 text-3xl flex sm:text-3xl text-gray-800 dark:text-white font-extrabold tracking-tight">
        Заказы</h3>
    <!-- <div class="p-4 mb-4 mt-4 w-100 mr-5 text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
        <span class="font-medium">Внимание!</span> Ремчик может падать. Все ок, я работаю над мелочами. Если что-то не пашет - пишите мне.
    </div> -->
    <div class="mt-3 mr-5">
      <orders></orders>
    </div>
@endsection
