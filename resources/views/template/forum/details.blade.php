@extends('template.forum.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')
            <div class="card mb-2">
                <div class="card-header">
                    <h2 class="my-3 float-left">{{$question->title}}</h2>
                    <div class="my-3 float-right">
                        <a href="/question/create" class="btn btn-sm btn-primary">Tambah Pertanyaan</a>
                    </div>
                </div>
                <!-- Blog Post -->
                <div class="card-body">
                    {!! $question->content !!}
                    @foreach ($answers as $item)
                        <div class="card shadow mb-4 border-0">
                            <div class="card-header p-0 d-flex align-items-center">
                                <div class="float-left m-0">
                                    <div class="btn btn-group-sm btn-group btn-group-toggle">
                                        <form action="/vote/answer/{{$item->id}}">
                                            <label for="up{{$item->id}}" class="btn btn-outline-success fa fa-arrow-alt-circle-up"></label>
                                            <label for="down{{$item->id}}" class="btn btn-outline-success fa fa-arrow-alt-circle-down"></label>
                                            <input type="radio" onchange='this.form.submit();'  name="vote" value="1" id="up{{$item->id}}" style="display: none">
                                            <input type="radio" onchange='this.form.submit();'  name="vote" value="-1" id="down{{$item->id}}" style="display: none" >
                                        </form>
                                        {{-- <a href="/vote/answer/1" class="btn btn-outline-success fa fa-arrow-alt-circle-up"></a>
                                        <a href="/vote/answer/0" class="btn btn-outline-danger fa fa-arrow-alt-circle-down"></a> --}}
                                    </div>
                                    <div style="display: inline">
                                        <a href="/user">{{$item->name}}</a>
                                    </div>
                                </div>
                                {{-- <h2 class="m-0">{{$item->title}}</h2> --}}
                            </div>

                            <div class="card-body">
{{--                                <p class="card-text">{!! $item->content !!}</p>--}}
                                {!! $item->content !!}
                                {{-- <a href="/question/{{$item->id}}" class="btn btn-primary">Read More &rarr;</a> --}}
                            </div>
                            {{-- <div class="card-footer text-muted">
                                Posted on {{$item->created_at}} by
                                <a href="/user/">{{$item->name}}</a>
                            </div> --}}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card border-0 p-0">
                <div class="card-body">
                    <form action="/answer/store" method="POST">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question->id}}" id="">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="content" rows="10" class="form-control my-editor">{!! old('content', $content ?? '') !!}</textarea>
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
      path_absolute : "/",
      selector: "textarea.my-editor",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);
  </script>
@endpush
