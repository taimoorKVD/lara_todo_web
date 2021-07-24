@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mt-5">
    <div class="card card-secondary card-outline" style="width: 38rem;">
        <div class="card-header">
            <div class="card-title float-left">
                {{ isset($todo) && $todo->todo ? 'Update Todo' : 'Create New Todo' }}
            </div>
            <div class="float-right">
                <a href="{{ route('todos.index') }}" class="btn btn-sm">
                    <span class="fa fa-arrow-left"></span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ isset($todo) && $todo->todo ? route('todos.update', encrypt($todo->id)) : route('todos.store') }}" method="post">
                @csrf
                
                @if(isset($todo))
                    @method('put')
                @endif
                
                <input type="text" class="form-control" name="todo" placeholder="Create new todo..." 
                value="{{ isset($todo) && $todo->todo ? $todo->todo : '' }}">
            </form>
        </div>
    </div>
</div>

@endsection