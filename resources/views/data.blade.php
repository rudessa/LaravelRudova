@extends('layouts.app')

@section('title', 'Все данные')

@section('content')
<div>
    <h2 style="font-size: 32px; color: #2d3748; margin-bottom: 20px;">Все полученные данные</h2>

    @if($data->isEmpty())
        <div style="background-color: #bee3f8; border: 1px solid #4299e1; color: #2c5282; padding: 15px; border-radius: 8px;">
            Данных пока нет. Заполните форму, чтобы добавить данные.
        </div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
                <thead>
                    <tr style="background-color: #4a5568; color: white;">
                        <th style="padding: 15px; text-align: left; font-weight: bold;">№</th>
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Имя</th>
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Email</th>
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Сообщение</th>
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Дата и время</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $item)
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 15px;">{{ $index + 1 }}</td>
                            <td style="padding: 15px;">{{ $item->name }}</td>
                            <td style="padding: 15px;">{{ $item->email }}</td>
                            <td style="padding: 15px;">{{ $item->message }}</td>
                            <td style="padding: 15px;">{{ $item->created_at->format('d.m.Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px; text-align: center;">
            <p style="color: #4a5568; font-weight: bold;">Всего записей: {{ $data->count() }}</p>
        </div>
    @endif
</div>
@endsection