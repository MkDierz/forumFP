@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">List Pertanyaan</h4>
                    <div class="float-right"><a href="/question/create" class="btn btn-sm btn-primary">Tambah Pertanyaan</a></div>
                </div>

                <div class="card-body">
                    @forelse ($questions as $data)
                        {{$data->title}}<br>
                        Oleh <a href="">{{$data->name}}</a><br>
                        <hr>
                    @empty
                        tidak ada data
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection