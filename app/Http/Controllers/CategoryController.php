<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnergeekRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $ctg = Category::get();
        return view('Energeek.index', compact('ctg'));
    }
    public function store(EnergeekRequest $request)
    {
        $user = User::create([
            'name'      => $request->user_name,
            'username'  => $request->user_username,
            'email'     => $request->user_email
        ]);

        foreach ($request->todos as $todo) {
            Task::create([
                'user_id'       => $user->id,
                'category_id'   => $todo['category_id'],
                'description'   => $todo['name']
            ]);
        }

        return redirect('/energeek')->with('success', 'haha sukses');
    }

    public function category()
    {
        return view('energeek');
    }
}
