@extends('layouts.admin')

@section('seo')
@endsection

@section('content')
    <div class="col-10">
        <div class="card card-info">
            <div class="card-header">
                <h1 class="card-title">Редактировать категорию: {{$category->title}}</h1>
            </div>
            <div class="card-body">
                <form action="{{route('admin.category.update')}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control @error('title')is-invalid @enderror "
                                       name="title"
                                       value="{{old('title',$order->title)}}" placeholder="Название...">
                                @error('title')
                                <span class="error invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Slug</label>
                                <input type="text" class="form-control @error('slug')is-invalid @enderror "
                                       name="slug"
                                       value="{{old('slug',$order->slug)}}" placeholder="Название...">
                                @error('slug')
                                <span class="error invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="parent_id">Родительская категория</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">- Select value-</option>
                                    @foreach($list as $id=>$title)
                                        <option
                                            @checked($id == $category->parent_id) value="{{$id}}">{{$title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea class="form-control" name="description">
                                    {{old('description',$category->description)}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Создать</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
