<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10|max:1000',
        ], [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Введите корректный email адрес.',
            'message.required' => 'Поле "Сообщение" обязательно для заполнения.',
            'message.min' => 'Сообщение должно содержать минимум 10 символов.',
            'message.max' => 'Сообщение не должно превышать 1000 символов.',
        ]);

        $validated['timestamp'] = now()->toDateTimeString();

        $filename = 'form_' . uniqid() . '_' . time() . '.json';

        Storage::disk('local')->put('forms/' . $filename, json_encode($validated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('form.show')->with('success', 'Данные успешно сохранены!');
    }

    public function showData()
    {
        $allData = [];

        $files = Storage::disk('local')->files('forms');

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $content = Storage::disk('local')->get($file);
                $data = json_decode($content, true);
                if ($data) {
                    $allData[] = $data;
                }
            }
        }

        return view('data', ['data' => $allData]);
    }
}