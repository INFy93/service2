@extends('layouts.app')

@section('title')
    Заказы
@endsection

@section('content')
    <h3 class=" mt-2 text-3xl flex sm:text-3xl text-gray-800 dark:text-white font-extrabold tracking-tight">
        Заказы</h3>
    <div class="p-4 mb-4 mt-4 w-100 mr-5 text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
        <span class="font-bold"> Обновление версии от 27/07/2022 </span> <br>
    - Полная ревизия кода: Composition API и Vue 3;<br>
	- Добавлено поле "Выполненные заказы" в окно изменения заказа; <br>
	- Исправлен баг со счетчиком открытых заказов (при добавлении нового заказа счетчик не обновлялся); <br>
	- Оптимизировны запросы к базе данных: улучшена производительность; <br>
    - Добавлен счетчик времени с момента добавления заказа и до его закрытия; <br>
	- Исправлены ошибки и улучшен интерфейс. <br>
    </div>
    <div class="mt-3 mr-5">
      <orders></orders>
    </div>
@endsection
