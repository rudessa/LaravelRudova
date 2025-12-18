<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormSubmission;

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

        FormSubmission::create($validated);

        return redirect()->route('form.show')->with('success', 'Данные успешно сохранены!');
    }

    public function showData()
    {
        $data = FormSubmission::orderBy('created_at', 'desc')->get();
        
        return view('data', ['data' => $data]);
    }
}