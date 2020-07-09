@extends('template.forum.master')
@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')
            <div class="card mb-2 border-0 shadow">
                <div class="card-header p-0 ">
{{--                    <div class="float-left m-0">--}}
{{--                        --}}
{{--                    </div>--}}
                    <div class="my-1 float-left">
                        {{--                        <a href="/question/create" class="btn btn-sm btn-primary">Tambah Pertanyaan</a>--}}
                        <div class="btn btn-group-sm btn-group btn-group-toggle  m-0">
                            <a href="" class="btn btn-outline-success fa fa-arrow-alt-circle-up"></a>
                            <a href="" class="btn btn-outline-danger fa fa-arrow-alt-circle-down"></a>
                        </div>
                    </div>
                    <div style="display: inline">
                        <h2 class="my-1 float-left">{{$question->title}}</h2>
                    </div>
                </div>
                <!-- Blog Post -->
                <div class="card-body">
                    {!! $question->content !!}

                </div>
            </div>

            @foreach ($answers as $item)
                <div class="card shadow mb-2 border-0">
                    <div class="card-header p-0 d-flex align-items-center">
                        <div class="float-left m-0">
                            <div class="btn btn-group-sm btn-group btn-group-toggle">
                                <a href="" class="btn btn-outline-success fa fa-arrow-alt-circle-up"></a>
                                <a href="" class="btn btn-outline-danger fa fa-arrow-alt-circle-down"></a>
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
            <div class="card border-0 p-0 shadow">
                <div class="card-header">
                    tambah jawaban
                </div>
                <div class="card-body">
                    <form action="/answer/store" method="POST">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question->id}}" id="">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="content" rows="10" class="form-control my-editor">{!! old('content', $content ?? '') !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
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
