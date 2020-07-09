@extends('template.forum.master')

@section('content')

            <div class="card border">
                <div class="card-header">
                    <h1 class="my-3 float-left">All Questions</h1>
                    <div class="my-3 float-right">
                        <a href="/question/create" class="btn btn-sm btn-primary">Tambah Pertanyaan</a>
                    </div>
                </div>
                <!-- Blog Post -->
                <div class="card-body">
                    @foreach ($questions as $item)
                        <div class="card shadow mb-4 border-0">
                            <div class="card-header p-0 d-flex align-items-center">
                                <div class="float-left m-0">
                                    <div class="btn btn-group-sm btn-group btn-group-toggle">
                                        <a href="" class="btn btn-outline-success fa fa-arrow-alt-circle-up"></a>
                                        <a href="" class="btn btn-outline-primary">num</a>
                                        <a href="" class="btn btn-outline-danger fa fa-arrow-alt-circle-down"></a>
                                    </div>
                                </div>
                                <h2 class="m-0">{{$item->title}}</h2>
                            </div>

                            <div class="card-body">
                                {!! $item->content !!}
                                <a href="/question/{{$item->id}}" class="btn btn-primary">Read More &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on {{$item->created_at}} by
                                <a href="/user/">{{$item->name}}</a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

@endsection
