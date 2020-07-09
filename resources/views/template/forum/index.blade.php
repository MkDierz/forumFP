@extends('template.forum.master')

@section('content')
    <div class="row p justify-content-center">

        <!-- left wigdet Widgets Column -->
        <div class="col-md-2 p-0">
            <!-- Categories Widget -->
            <ul class="navbar-nav sidebar-light m-0">

                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <hr class="sidebar-divider">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">
                        <i class="fas fa-fw fa-home"></i>
                        <span>Homes</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Pages
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Components</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Components:</h6>
                            <a class="collapse-item" href="buttons.html">Buttons</a>
                            <a class="collapse-item" href="cards.html">Cards</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Utilities</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Utilities:</h6>
                            <a class="collapse-item" href="utilities-color.html">Colors</a>
                            <a class="collapse-item" href="utilities-border.html">Borders</a>
                            <a class="collapse-item" href="utilities-animation.html">Animations</a>
                            <a class="collapse-item" href="utilities-other.html">Other</a>
                        </div>
                    </div>
                </li>

            </ul>

        </div>

        <!-- Blog Entries Column -->
        <div class="col-md-7 p-0">
            <div class="card">
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
                                        <a href="" class="btn btn-outline-danger fa fa-arrow-alt-circle-down"></a>
                                    </div>
                                </div>
                                <h2 class="m-0">{{$item->title}}</h2>
                            </div>
        
                            <div class="card-body">
                                <p class="card-text">{{$item->content}}</p>
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
                
           
        </div>

        <!-- right wigdet Widgets Column -->
        <div class="col-md-2">

            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                            <li>
                                <a href="#">HTML</a>
                            </li>
                            <li>
                                <a href="#">Freebies</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and
                    feature the new Bootstrap 4 card containers!
                </div>
            </div>
        </div>
    </div>
@endsection