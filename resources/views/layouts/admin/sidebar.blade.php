  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
          <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">{{ __('backend.system_name') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                  <li class="nav-item">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              {{ __('backend.dashboard') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.crud.index', ['model' => 'Service']) }}" class="nav-link">
                          <i class="nav-icon fas fa-cubes"></i>
                          <p>
                              {{ __('backend.services') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.clubs.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-cubes"></i>
                          <p>
                              {{ __('backend.clubs.clubs') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.crud.index', ['model' => 'Client']) }}" class="nav-link">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              {{ __('backend.client') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.faqs.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-question"></i>
                          <p>
                              {{ __('backend.faqs') }}
                          </p>
                      </a>
                  </li>
                  {{-- <li class="nav-item">
                      <a href="{{ route('admin.project-related-crud.index', ['model' => 'ProjectType']) }}"
                          class="nav-link">
                          <i class="nav-icon fas fa-cubes"></i>
                          <p>
                              أنواع التعدات
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.project-related-crud.index', ['model' => 'ProjectArea']) }}"
                          class="nav-link">
                          <i class="nav-icon fas fa-map"></i>
                          <p>
                              المناطق
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.project-related-crud.index', ['model' => 'ProjectSector']) }}"
                          class="nav-link">
                          <i class="nav-icon fas fa-cube"></i>
                          <p>
                              القطاع
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.project-related-crud.index', ['model' => 'ProjectBoard']) }}"
                          class="nav-link">
                          <i class="nav-icon fas fa-chess-board"></i>
                          <p>
                              اللجان
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.project-related-crud.index', ['model' => 'ProjectAction']) }}"
                          class="nav-link">
                          <i class="nav-icon fas fa-bars"></i>
                          <p>
                              الإجراءات
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.report.index') }}"
                          class="nav-link">
                          <i class="nav-icon fas fa-file"></i>
                          <p>
                              التقارير
                          </p>
                      </a>
                  </li> --}}
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
