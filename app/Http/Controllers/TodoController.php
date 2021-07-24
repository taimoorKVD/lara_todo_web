<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('todo.index')
            ->withTodos(Todo::orderBy('created_at', 'desc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create-update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $todo = new Todo();
        $todo->todo = request()->todo;
        
        try {
            $todo->save();
            return redirect()
                ->route('todos.index')
                ->with('success-message', 'Todo created successfully.');
        } catch ( \Exception $e) {
            return redirect()
            ->back()
            ->with('error-message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsCompleted($id)
    {
        $todo = Todo::find(decrypt($id));
        try {
            $todo->status = 1;
            $todo->save();
            return redirect()
                ->route('todos.index')
                ->with('success-message', 'Todo marked as completed successfully.');
        } catch ( \Exception $e) {
            return redirect()
            ->back()
            ->with('error-message', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('todo.create-update')
            ->withTodo(Todo::find(decrypt($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $todo = Todo::find(decrypt($id));
        try {
            $todo->todo = request()->todo;
            $todo->save();
            return redirect()
                ->route('todos.index')
                ->with('success-message', 'Todo updated successfully.');
        } catch ( \Exception $e) {
            return redirect()
            ->back()
            ->with('error-message', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        $todo = Todo::find(decrypt($id));
        try {
            $todo->delete();
            return redirect()
                ->back()
                ->with('success-message', 'Todo deleted successfully.');
        } catch ( \Exception $e) {
            return redirect()
            ->back()
            ->with('error-message', $e->getMessage());
        }
    }
}
