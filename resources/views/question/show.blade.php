@extends('template.admin.master')

@section('content')
    <div id="question-header" class="container">

        <div class="d-flex justify-content-between" style="display: inline">
            <h1 itemprop="name" class="" >{{$details->title}}</h1>
            <div>
                <a href="/questions/ask" class="btn btn-primary" style="display: inline">buat pertanyaan</a>
            </div>
            

        </div>
        <div class="" title="2008-10-03 22:47:43Z">
            <span class="dibuat">dibuat</span>
            <time itemprop="dateCreated" datetime="2008-10-03T22:47:43"></time>
        </div>
        
        <div class="d-flex bd-highlight">
            <div class="p-2 flex-shrink-1 bd-highlight">
                <div class="d-flex flex-column">
                    <div class="fa fa-caret-up fa-4x"></div>
                    <div class="d-flex justify-content-center" style="font-size: 32px" >0</div>
                    <div class="fa fa-caret-down fa-4x"></div>
                </div>
            </div>
            <div class="p-2 w-100 bd-highlight">{{$details->content}}</div>
            
          </div>
    </div>
@endsection