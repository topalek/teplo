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
                            <h3 class="card-title">Категории</h3>
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
                                @if(!empty($categories))
                                    <table class="table table-bordered table-hover dataTable dtr-inline"
                                           aria-describedby="example2_info">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                            <th>Родительская</th>
                                            <th>Описание</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr class="{{$loop->even?'even':'odd'}}">
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->title}}</td>
                                                <td>{{$category->parent_title}}</td>
                                                <td>{{$category->description}}</td>
                                                <td>
                                                    <a href="{{route('admin.category.edit',$category)}}"
                                                       class="btn btn-success">Edit</a>
                                                    <a href="{{route('admin.category.destroy',$category)}}"
                                                       class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{$categories->links()}}
                                @else
                                    <p>Пока ничего нет </p>
                                    <p><a href="{{route('admin.category.create')}}" class="btn btn-success">Создать
                                            новую</a></p>
                                @endif
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
