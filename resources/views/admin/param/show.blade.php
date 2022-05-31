@extends('layouts.admin')

@section('seo')
@endsection

@section('content')
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="card-title">Категориия: {{$category->title}}</h3>
                        </div>
                        <div class="col-3">
                            <a href="{{route('admin.category.create')}}" class="btn btn-success">Создать новую</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline">
                                    <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{$category->id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Название</th>
                                        <td>{{$category->title}}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug</th>
                                        <td>{{$category->slug}}</td>
                                    </tr>
                                    <tr>
                                        <th>Родительская</th>
                                        <td>{{$category->parent_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Описание</th>
                                        <td>{{$category->description}}</td>
                                    </tr>
                                    <tr>
                                        <th>Создана</th>
                                        <td>{{$category->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Обновлена</th>
                                        <td>{{$category->updated_at}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p>
                                    <a href="{{route('admin.category.create')}}" class="btn btn-success">Создать
                                        новую</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection
