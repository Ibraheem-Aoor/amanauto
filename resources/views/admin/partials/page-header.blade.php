   <!-- Content Header (Page header) -->
   <div class="content-header">
       <div class="container-fluid">
           <div class="row mb-2">
               <div class="col-sm-6">
                   <h1 class="m-0 text-dark">{{ $main_section }}</h1>
               </div><!-- /.col -->
               <div class="col-sm-6">
                   <ol class="breadcrumb float-sm-right">
                       @isset($section)
                           <li class="breadcrumb-item"><a href="@yield('section_link')">{{ $section }}</a></li>
                       @endisset
                       @isset($page)
                           <li class="breadcrumb-item active">{{ $page }}</li>
                       @endisset
                   </ol>
               </div><!-- /.col -->
           </div><!-- /.row -->
       </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
