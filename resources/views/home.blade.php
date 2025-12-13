@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div style="text-align: center; padding: 40px 20px;">
    <h2 style="font-size: 36px; color: #2d3748; margin-bottom: 20px;">Добро пожаловать в SvetlanaApp!</h2>
    <p style="font-size: 18px; color: #4a5568; margin-bottom: 30px;">
        Это тестовое приложение на Laravel для работы с формами и данными.
    </p>
    <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('form.show') }}" style="background-color: #4299e1; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; transition: background-color 0.3s;">
            Перейти к форме
        </a>
        <a href="{{ route('data.show') }}" style="background-color: #48bb78; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; transition: background-color 0.3s;">
            Просмотреть данные
        </a>
    </div>
</div>
@endsection