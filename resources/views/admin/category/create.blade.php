@extends('layouts.admin')

@section('seo')
@endsection

@section('title')
    Создать категорию
@endsection

@section('content')
    <div class="col-10">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Input Addon</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.category.store')}}" method="post">
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
                                <label for="parent_id">Родительская категория</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">- Select value-</option>
                                    <option value="1">Category 1</option>
                                    <option value="2">Category 2</option>
                                    <option value="3">Category 3</option>
                                    <option value="4">Category 4</option>
                                    <option value="5">Category 5</option>

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
