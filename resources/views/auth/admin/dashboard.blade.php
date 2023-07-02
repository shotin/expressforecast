<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/styleDash.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-popover-x.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <title>Express Forecast</title>
</head>

<body>
     <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg sidebar-dark fixed-top">
                <a class="navbar-brand text-danger" href="home.php"><img style="width:30px;" src="../img/ICON.png" class="img-fluid" style="width:120px" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                              
                            </ul>
                        </li>
                        
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="42" class="rounded-circle" src="assets/images/user.png" alt=""></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{ auth()->guard('admin')->user()->email }} </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
       
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="{{ route('dashboard') }}" aria-expanded="false"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="{{ route('registerusers') }}"  aria-expanded="false"><i class="fa fa-fw fa-user-circle"></i>Register Users</a>
                            </li>
                            <li class="nav item">                        
                              <a  class="dropdown-item" href="{{ route('adminLogout') }}" class="custom-button1"> <i class="fas fa-power-off mr-2"></i>Logout</a>                  
                            </li>                     
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">WELCOME {{ auth()->guard('admin')->user()->name }}  </h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">

                    <div class="row">
                         
                        </div>
                        <div class="row">
                        @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                         
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                <h5 class="card-header">FORECAST IMAGE BANNER</h5> 
                                    <div class="col col-sm-1 mb-3 mt-2"> 
                                        <button type="button" id="export_button" class="btn btn-sm text-dark"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                        @if(count($image) > 0)
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="border-0">No</th>
                                                    <th class="border-0">Image</th>  
                                                    <th class="border-0">Start Date</th>  
                                                    <th class="border-0">End Date</th>  
                                                    <th class="border-0">Link</th>  
                                                    <th class="border-0">Action</th>                                                    
                                                    <th class="border-0">Date Created</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($image as $image)
                                                    @php
                                                        $currentDate = \Carbon\Carbon::now();
                                                        $endDate = \Carbon\Carbon::parse($image->end_date);
                                                    @endphp
                                                    @if ($currentDate->lte($endDate))
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><img src="{{ asset('storage/images/'.$image->image) }}" alt="" width="200px" height="200px"></td>
                                                            <td>{{ $image->created_at }}</td>
                                                            <td>{{ $image->end_date }}</td>
                                                            <td>{{ $image->link }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editBannerModal" data-id="{{ $image->id }}"><i class="fas fa-edit"></i></button>
                                                                <form style="margin-top: 28px;" action="{{url('/delete', $image->id)}}" method="POST" enctype="multipart/form-data" id="delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash-alt btn btn-link"></i></button>
                                                                    &nbsp; &nbsp;
                                                                </form>
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($image->created_at)->diffForHumans() }}</td> 
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center fw-bolder text-uppercase p-5">No banner available</p>
                                    @endif

                                        </div>
                                    </div>
                                </div>
                            </div>                         
                        </div>                     
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        Copyright © 2022 ExpressForecast. All rights reserved <a href=""></a>.<a href=""></a>.
                        </div>
                      
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title w-100" id="exampleModalLabel">Enter Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{url('/upload')}}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="formFile" class="form-label">Choose Banner Image</label>
        <input type="file" name="image" id="" class="form-control">

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required min="{{ date('Y-m-d') }}">

        <label for="link">Link</label>
        <input type="text" name="link">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
    
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this image?
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-danger w-100" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editBannerModal" tabindex="-1" role="dialog" aria-labelledby="editBannerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      @if($image != null)
      <form action="{{url('/edit', optional($image)->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choose Banner Image</label>
                    <input type="file" name="image" id=""  value="{{ $image->image }}" class="form-control">
                </div>
        </div>
          <div class="mb-3">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" value="{{ $image->end_date }}" min="{{ date('Y-m-d') }}" required>
          </div>

          <div class="mb-3">
            <label for="end_date">Link</label>
            <input type="text" name="link" value="{{ $image->link }}"  class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        @endif

      </div>
    </div>
  </div>
</div>


    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/magnific-popup.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/countdown.min.js')}}"></script>
<script src="{{asset('js/bootstrap-popover-x.min.js')}}"></script>
<script src="{{asset('js/amd.js')}}"></script>
<script src="{{asset('js/nice-select.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/main-js.js')}}"></script>

</body>
</html>