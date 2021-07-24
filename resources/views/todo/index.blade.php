@extends('layouts.app')
@section('content')


@include('partials.alert')

<div class="card card-secondary card-outline">
    <div class="card-header">
        <div class="card-title float-left">
            Todos
        </div>
        <div class="float-right">
            <a href="{{ route('todos.create') }}" class="btn btn-sm">
                <span class="fa fa-plus"></span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($todos as $todo)
            <li class="list-group-item float-left">
                {{ $todo->todo }}
                <button class="btn btn-sm mr-2 float-right delete" data-id="{{ encrypt($todo->id) }}">
                    <span class="fa fa-trash"></span>
                </button>
                @if(!$todo->status)
                <a href="{{ route('todos.edit', [ 'todo' => encrypt($todo->id) ]) }}" class="btn btn-sm float-right">
                    <span class="fa fa-edit"></span>
                </a>
                <button class="btn btn-sm float-right complete" data-id="{{ encrypt($todo->id) }}">
                    <span class="fa fa-check-double"></span>
                </button>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $todos->links() }}
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteTagForm">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="modal fade" id="markAsCompletedModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="markAsCompletedForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mark As Complete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to mark as completed this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                    <button type="submit" class="btn btn-danger">Yes, Complete</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
           $('.delete').on('click', function(){
                var form = document.getElementById('deleteTagForm');
                var id = $(this).attr('data-id');
                form.action = '{!! url('todos') !!}'+'/'+id;
                $('#deleteModal').modal('show');
           });

           $('.complete').on('click', function(){
                var form = document.getElementById('markAsCompletedForm');
                var id = $(this).attr('data-id');
                form.action = '{!! url('/todos/todo/') !!}'+'/'+id;
                $('#markAsCompletedModal').modal('show');
           });
        });
    </script>
@endsection