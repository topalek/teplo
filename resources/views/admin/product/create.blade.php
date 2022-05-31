@extends('layouts.admin')

@section('seo')
@endsection

@section('content')
    <div class="col-10">
        <div class="card card-info">
            <div class="card-header">
                <h1 class="card-title">Создать товар</h1>
            </div>
            <div class="card-body">
                <form action="{{route('admin.product.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control @error('title')is-invalid @enderror "
                                       name="title"
                                       value="{{old('title')}}" placeholder="Enter email">
                                @error('title')
                                <span class="error invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category_id">Категория</label>
                                <select name="category_id" class="form-control">
                                    <option value="">- Select value-</option>
                                    @foreach($list as $id=>$title)
                                        <option value="{{$id}}">{{$title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">Описание</label>
                                <textarea class="form-control" name="title"></textarea>
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
