@extends('template.forum.master')
@push('script-head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')
    <div class="card mb-2 rounded-0">
        <div class="card-header">
            <h2 class="my-3 float-left">{{$question->title}}</h2>
            <div class="my-3 float-right">
                <a href="/question/create" class="btn btn-sm btn-primary">Tambah Pertanyaan</a>
            </div>
        </div>
        <!-- Blog Post -->
        <div class="card-body">
            {!! $question->content !!}
            <a href="/questionComment/show/{{$question->id}}"><i class="fa fa-comment"></i> Komentar</a>
            <small>({{$questionc}} Komentar)</small>
            <hr>
{{--            <h3>Jawaban</h3>--}}
            @foreach ($answers as $item)
                <div class="card mb-4  rounded-0">
                    <div class="card-header p-0 d-flex align-items-center">
                        <div class="float-left m-0">

                            <div class="btn btn-group-sm btn-group btn-group-toggle pr-0">
                                <form action="/vote/answer/{{$question->id}}" method="POST">
                                    @csrf
                                    <div class="btn btn-group-sm btn-group btn-group-toggle px-0">
                                        <label for="up{{$item->id}}"
                                               class="btn btn-outline-success fa fa-arrow-alt-circle-up"></label>
                                        <label href="" class="btn btn-primary" style="cursor:default;">{{$item->jumlah_vote}}</label>
                                        <label for="down{{$item->id}}"
                                               class="btn btn-outline-danger fa fa-arrow-alt-circle-down"></label>
                                        <input type="hidden" name="id" value="{{$item->id}}">

                                        
                                        <input type="radio" onchange='this.form.submit();' name="vote" value="1"
                                                id="up{{$item->id}}" style="display: none">
                                        <input type="radio" onchange='this.form.submit();' name="vote" value="-1"
                                                id="down{{$item->id}}" style="display: none">

                                    </div>
                                    {{-- <div style="display: inline">
                                        <a href="/user">{{$item->user->name}}</a>
                                    </div>
                                    
                                    </div> --}}
                                    {{-- <h2 class="m-0">{{$item->title}}</h2> --}}
                                </form>

                            </div>

                            <div style="display: inline">
                                <a href="/user">{{$item->user->name}} </a><i class="text-xs "> menjawab </i>

                            </div>


                        </div>


                        {{-- <h2 class="m-0">{{$item->title}}</h2> --}}
                    </div>

                    <div class="card-body">
                        @if ($item->is_selected == 1)
                            <div class="">
                                <button class="btn btn-warning ml-2 mr-2 float-right" style="cursor:default;"><i class="fa fab fa-star"></i>Jawaban terbaik</button>
                            </div>
                        @endif
                        {{--                                <p class="card-text">{!! $item->content !!}</p>--}}
                        {!! $item->content !!}
                        {{-- <a href="/question/{{$item->id}}" class="btn btn-primary">Read More &rarr;</a> --}}
                    </div>
                    {{-- <div class="card-footer text-muted">
                        Posted on {{$item->created_at}} by
                        <a href="/user/">{{$item->name}}</a>
                    </div> --}}
                    <div class="card-footer text-muted">
                        <a href="/answerComment/show/{{$item->id}}"><i class="fa fa-comment"></i> Komentar</a>
                        <small>({{$item->answer_comments_count}} Komentar)</small>
                        <div class="float-right" style="display: inline">
                        @guest

                        @else
                            @if ($item->pembuat_jawaban_id == Auth::user()->id)

{{--                                    <a class="btn btn-sm btn-success">Relevan</a>--}}
                                    <a href="#" class="btn btn-sm btn-info">ubah</a>
                                    <a href="#" class="btn btn-sm btn-danger">hapus</a>

                            @endif
                            @if ($question->pembuat_pertanyaan_id == Auth::user()->id)
                                @if ($item->is_selected == 1)
{{--                                <div class="float-right" style="display: inline">--}}
                                        <a href="/answer/lepasrelevan/{{$question->id}}" class="btn btn-sm btn-danger">lepas Relevan</a>
{{--                                </div>--}}
                                    @else
{{--                                <div class="float-right" style="display: inline">--}}
                                        <a href="/answer/relevan/{{$item->id}}/{{$question->id}}" class="btn btn-sm btn-success">Relevan</a>
{{--                                </div>--}}
                                @endif

                            @endif
                        @endguest
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    <div class="card border-0 p-0">
        <div class="card-body">
            <h2>Jawab</h2>
            <form action="/answer/store" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{$question->id}}" id="">
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea name="content" rows="10"
                                  class="form-control my-editor">{!! old('content', $content ?? '') !!}</textarea>
                    </div>
                </div>
                <div class="form-group row mb-5">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('script-body')
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: "textarea.my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endpush
