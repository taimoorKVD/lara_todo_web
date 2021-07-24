@extends('layouts.app')
@section('content')


@include('partials.alert')

<div class="card card-secondary card-outline">
    <div class="card-header">
        <div class="card-title float-left">
            Todos
        </div>
        <div class="float-right">
        <form action="{{ route('todos.store') }}" method="post">
            @csrf
            <input type="text" class="form-control" name="todo" placeholder="Create new todo..." style="width: 500px;">
        </form>
        </div>
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($todos as $todo)
            <li class="list-group-item float-left">
                {{ $todo->todo }}
                <a href="{{ route('todos.destroy', $todo->id) }}" class="btn btn-sm float-right ml-2 delete" data-confirm="Are you sure to delete this item?">
                    <span class="fa fa-trash"></span>
                </a>
                <a href="{{ route('todos.edit', [ 'todo' => $todo->id ]) }}" class="btn btn-sm float-right">
                    <span class="fa fa-edit"></span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $todos->links() }}
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.delete').on("click", function (e) {
            e.preventDefault();
            if (confirm($(this).attr('data-confirm'))) {
                window.location.href = $(this).attr('href');
            }
        });
    });
</script>
@endsection