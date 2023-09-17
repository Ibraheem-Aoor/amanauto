  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ route('home') }}" class="nav-link" target="_blank"><i class="fa fa-globe"></i></a>
          </li>
      </ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav @if(app()->getLocale() == 'ar') mr-auto-navbav @else ml-auto @endif">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-language"></i>
                <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @foreach (getAvilableLocales() as $locale)
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('change_language', ['locale' => $locale]) }}"
                        class="dropdown-item text-center ">
                        {{ $locale == 'ar' ? 'العربية' : 'English' }}
                    </a>
                @endforeach
            </div>

        </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-envelope mr-2"></i> 4 new messages
                      <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-users mr-2"></i> 8 friend requests
                      <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-file mr-2"></i> 3 new reports
                      <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->



  {{-- <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" style="visibility: hidden;">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-language"></i>
                <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @foreach (getAvilableLocales() as $locale)
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('change_language' , ['locale' => $locale]) }}"  class="dropdown-item text-center ">
                        {{ $locale == 'ar' ? 'العربية' : 'English' }}
                    </a>
                @endforeach
            </div>

        </li>
    </ul>

    <ul class="navbar-nav mr-auto-navbav">
        <li class="nav-item dropdown">

            <a class="btn btn-danger" onclick="$('#logout-form').submit();" class="dropdown-item text-center ">
                خروج
                <i class="fa fa-arrow-left"></i>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">
                @csrf
            </form>

        </li>
    </ul>
</nav>
<!-- /.navbar --> --}}
