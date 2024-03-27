<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
//use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
           // 'todos' => todo::where('user_id', Auth::id())->latest()->get(),
            'todos' => Auth::user()->todos()->latest('id')->get(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
        ]);

        $todo = Todo::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return response()->json([
            'todo' => $todo
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //$todo = Todo::findOrFail($id);

        $this->validate($request,[
            'name' => ['required'],
            'status' =>['required']
        ]);

        //$todo->update($request->all());

        $todo = Todo::update([
            'user_id' => Auth::id(),
            'name'=> $request->name,
            'status' => $request->status
        ]);
        
        return response()->json([
            'todo' => $todo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
