@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-10">
            <h2 class="text-muted py-3 float-left"style="font-size:40px">やること一覧</h2>
            <div class="float-right my-3">
                <a href="/todo/create/" class="btn btn-primary"><i class="fas fa-plus mr-2"style="font-size:30px"></i>新規作成</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th width="30%">タイトル</th>
                    <th width="10%">期限</th>
                    <th width="10%">状態</th>
                    <th width="15%"></th>
                    <th width="15%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($todo_list as $todo)
                    <tr>
                        <td>
                            <a href="/todo/{{ $todo->id }}">
                                {{ $todo->title }}
                            </a>
                        </td>
                        <td>{{ $todo->due_date }}</td>
                        <td>
                            {{ $todo->getStatusText() }}
                        </td>
                        <td>{{ $todo->getDisplayDate() }}</td>
                        <th>
                            <a href="/todo/{{ $todo->id }}/edit" class="btn btn-success"><i class="fas fa-edit mr-2"></i>編集</a>
                        </th>
                        <th>
                        <button class="btn btn-danger delete-btn" type="button" data-toggle="modal" data-target="#delete-modal" data-todo_title="{{ $todo->title }}" data-todo_id="{{ $todo->id }}">
                                <i class="fas fa-trash-alt mr-2"></i>削除
                            </button>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $todo_list->links() }}
        </div>
    </div>
    @include('parts.modal.delete')
@endsection

@section('script')
    <script src="{{ asset('/js/todo/app.js') }}"></script>
@endsection