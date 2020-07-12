@extends('template.forum.master')

@section('content')

            <div class="card border rounded-0">
                <div class="card-header">
                    <h1 class="my-3 float-left">All Questions</h1>
                    <div class="my-3 float-right">
                        <a href="/question/create" class="btn btn-sm btn-primary">Tambah Pertanyaan</a>
                    </div>
                </div>
                <!-- Blog Post -->
                <div class="card-body">
                    @foreach ($questions as $item)
                        <div class="card shadow mb-4 border-1 rounded-0">
                            <div class="card-header p-0 d-flex align-items-center">
                                <div class="float-left m-0">
                                    <div class="btn btn-group-sm btn-group btn-group-toggle p-0">
                                        @guest
                                        
                                        @else
                                            <form action="/vote/question/{{$item->id}}" method="POST">
                                                @csrf
                                                <div class="btn btn-group-sm btn-group btn-group-toggle">
                                                    <label for="up{{$item->id}}" class="btn btn-outline-success fa fa-arrow-alt-circle-up"></label>
                                                    <label href="" class="btn btn-primary">{{$item->jumlah_vote}}</label>
                                                    <label for="down{{$item->id}}" class="btn btn-outline-danger fa fa-arrow-alt-circle-down"></label>
                                                </div>
                                                
                                                @if ($item->last_value == 0)
                                                    <input type="radio" onchange='this.form.submit();' name="vote" value="1"
                                                            id="up{{$item->id}}" style="display: none">
                                                    <input type="radio" onchange='this.form.submit();' name="vote" value="-1"
                                                    id="down{{$item->id}}" style="display: none">
                                                @else 
                                                    @if ($item->last_value == 1)
                                                        <input type="radio" onchange='this.form.submit();' name="vote" value="1" id="up{{$item->id}}" style="display: none">
                                                        <input type="radio" onchange='this.form.submit();' name="vote" value="0" id="down{{$item->id}}" style="display: none">
                                                    @else
                                                        <input type="radio" onchange='this.form.submit();' name="vote" value="0" id="up{{$item->id}}" style="display: none">
                                                        <input type="radio" onchange='this.form.submit();' name="vote" value="-1" id="down{{$item->id}}" style="display: none">
                                                    @endif
                                                    
                                                @endif



                                                    {{-- <input type="radio" onchange='this.form.submit();'  name="vote" value="1" id="up{{$item->id}}" style="display: none">
                                                    <input type="radio" onchange='this.form.submit();'  name="vote" value="-1" id="down{{$item->id}}" style="display: none" > --}}
                                            </form>

                                        @endguest
                                    </div>
                                </div>
                                <h2 class="m-0"><a href="/question/{{$item->id}}">{{$item->title}}</a></h2>
                            </div>
                            <div class="card-body">
                                {!! $item->content !!}
                                <hr>
                                @foreach ($tags as $tag)
                                    @if ($tag->questions_id == $item->id)
                                        <a href="" class="btn btn-sm btn-secondary">{{$tag->tag}}</a>
                                    @endif
                                @endforeach
                                <br>
                                {{-- <a href="/question/{{$item->id}}" class="btn btn-primary">Read More &rarr;</a> --}}
                                <a href="/question/{{$item->id}}"><b>{{$item->answers_count}} Jawaban</b></a>
                                <br>

                            </div>
                            <div class="card-footer text-muted">
                                Posted on {{$item->created_at}} by
                                <a href="/user/{{$item->users->id}}">{{$item->users->name}}</a>
                                @guest

                                @else
                                @if ($item->pembuat_pertanyaan_id == Auth::user()->id)
                                <div class="float-right" style="display: inline">
                                    <a href="/question/edit/{{$item->id}}" class="btn btn-sm btn-info"><i class="fa fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{$item->id}}"><i class="fa fa-trash"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            Yakin ingin menghapus pertanyaan "<b>{{$item->title}}</b>" ?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form method="post" action="/question/{{$item->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">Yakin</button>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endguest
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
@endsection
