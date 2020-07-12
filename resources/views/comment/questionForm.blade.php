@extends('template.forum.master')
@push('script-head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-12">--}}
            <div class="card">
                <div class="card-header">Komentar Jawaban</div>

                <div class="card-body">
                    {!!$question->content!!}
                    <hr>
                    @forelse ($comment as $item)
                    <small>
                        {{$item->created_at}}
                        <br><a href="">{{$item->name}}</a> : {{$item->content}}
                    </small>
                    <hr>
                    @empty
                        <small>tidak ada komentar sebelumnya</small>
                        <hr>
                    @endforelse

                    @guest
                    <div class="form-group row mb-0">
                      <div class="col-md-12">
                          Silahkan <a href="/login">Login</a> untuk memberikan komentar.<br>
                          <a href="/question/{{$question->id}}" class="">Kembali ke Pertanyaan</a>
                      </div>
                    </div>
                    @else
                    <form method="POST" action="/questionComment/store">
                      @csrf
                      <input type="hidden" name="questions_id" value="{{$question->id}}">
                      <div class="form-group row">
                          <div class="col-md-12">
                              <input type="text" name="content" placeholder="Tulis Komentar Disini" class="form-control">
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-12">
                              <button type="submit" class="btn btn-primary">
                                  Kirim Komentar
                              </button>
                              <a href="/question/{{$question->id}}" class="btn btn-warning">Kembali ke Pertanyaan</a>
                          </div>
                      </div>
                    </form>
                    @endguest
                </div>
            </div>
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
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
