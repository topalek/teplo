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
                            <h3 class="card-title">Товары</h3>
                        </div>
                        <div class="col-3">
                            <a href="{{route('admin.product.create')}}" class="btn btn-success">Создать новый</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                @if(!empty($products))
                                    <table class="table table-bordered table-hover dataTable dtr-inline"
                                           aria-describedby="example2_info">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                            <th>Категория</th>
                                            <th>Описание</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr class="{{$loop->even?'even':'odd'}}">
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->title}}</td>
                                                <td>{{$product->category->title}}</td>
                                                <td>{{$product->title}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{$products->links()}}
                                @else
                                    <p>Пока ничего нет </p>
                                    <p><a href="{{route('admin.product.create')}}" class="btn btn-success">Создать
                                            новый</a></p>
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
