@extends('layouts.app')

@section('title', 'Форма обратной связи')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <h2 style="font-size: 32px; color: #2d3748; margin-bottom: 20px;">Форма обратной связи</h2>

    @if(session('success'))
        <div style="background-color: #c6f6d5; border: 1px solid #48bb78; color: #22543d; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background-color: #fed7d7; border: 1px solid #f56565; color: #742a2a; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach($errors->all() as $error)
                    <li style="margin-bottom: 5px;">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('form.submit') }}" method="POST" style="background-color: #f7fafc; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; font-weight: bold; margin-bottom: 8px; color: #2d3748;">Имя:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 16px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; font-weight: bold; margin-bottom: 8px; color: #2d3748;">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 16px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="message" style="display: block; font-weight: bold; margin-bottom: 8px; color: #2d3748;">Сообщение:</label>
            <textarea id="message" name="message" rows="5" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 16px; resize: vertical;">{{ old('message') }}</textarea>
        </div>

        <button type="submit" style="background-color: #4299e1; color: white; padding: 12px 30px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; width: 100%; transition: background-color 0.3s;">
            Отправить
        </button>
    </form>
</div>
@endsection