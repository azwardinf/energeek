<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnergeekRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'user_name'             => 'Nama',
            'user_username'         => 'Username',
            'user_email'            => 'Email',
            'todos'                 => 'Todos',
            'todos.*'               => 'Todos',
            'todos.*.category_id'   => 'Kategori',
            'todos.*.description'   => 'Judul'
        ];
    }

    public function rules()
    {
        return [
            'user_name'             => 'required',
            'user_username'         => 'required|unique:users,username',
            'user_email'            => 'required|email|unique:users,email',
            'todos'                 => 'required',
            'todos.*'               => 'required|array',
            'todos.*.category_id'   => 'required|exists:categories,id',
            'todos.*.description'   => 'nullable'
        ];
    }
}
