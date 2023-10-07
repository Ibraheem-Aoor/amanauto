  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
          <img src="{{ asset('assets/user/img/Group 4927.svg') }}" alt="AdminLTE Logo" class="brand-image  elevation-3">
          <span class="brand-text font-weight-light">{{ __('backend.system_name') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ getAuthUser('admin')->name }}</a>
              </div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                  <li class="nav-item">
                      <a href="{{ route('admin.dashboard') }}"
                          class="nav-link {{ areActiveRoutes(['admin.dashboard']) }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              {{ __('backend.dashboard') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.crud.index', ['model' => 'Service']) }}"
                          class="nav-link {{ areActiveRoutes(['admin.crud.index']) }}">
                          <i class="nav-icon fas fa-cubes"></i>
                          <p>
                              {{ __('backend.services') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.clubs.index') }}"
                          class="nav-link {{ areActiveRoutes(['admin.clubs.index']) }}">
                          <i class="nav-icon ion ion-bag"></i>
                          <p>
                              {{ __('backend.clubs.clubs') }}
                          </p>
                      </a>
                  </li>
                  {{-- offers --}}
                  <li
                      class="nav-item menu-is-opening  {{ areActiveRoutes(['admin.offer.index', 'admin.offer-company.index'], 'menu-open') }} ">
                      <a href="#"
                          class="nav-link {{ areActiveRoutes(['admin.offer.index', 'admin.offer-company.index']) }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              {{ __('backend.offers.offers') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: block;">
                          <li class="nav-item">
                              <a href="{{ route('admin.offer-company.index') }}"
                                  class="nav-link {{ areActiveRoutes(['admin.offer-company.index']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.offers.offer_companies') }}</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.offer.index') }}"
                                  class="nav-link {{ areActiveRoutes(['admin.offer.index']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.offers.offers') }}</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- subscribers --}}
                  <li
                      class="nav-item menu-is-opening {{ areActiveRoutes(['admin.users.index', 'admin.subscribtions.index'], 'menu-open') }}">
                      <a href="#"
                          class="nav-link {{ areActiveRoutes(['admin.users.index', 'admin.subscribtions.index']) }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              {{ __('backend.users.user_and_subscribtions') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: block;">
                          <li class="nav-item">
                              <a href="{{ route('admin.users.index') }}"
                                  class="nav-link {{ areActiveRoutes(['admin.users.index']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.users.all_users') }}</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.users.index', ['view_subscriptions' => true]) }}"
                                  class="nav-link {{ areActiveRoutes(['admin.users.index']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.users.all_subscribers') }}</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.coupons.index') }}"
                          class="nav-link {{ areActiveRoutes(['admin.coupons.index']) }}">
                          <i class="nav-icon fas fa-cubes"></i>
                          <p>
                              {{ __('backend.coupons.coupons') }}
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
                      <a href="{{ route('admin.faqs.index') }}"
                          class="nav-link {{ areActiveRoutes(['admin.faqs.index']) }}">
                          <i class="nav-icon fas fa-question"></i>
                          <p>
                              {{ __('backend.faqs') }}
                          </p>
                      </a>
                  </li>
                  {{-- Pages --}}
                  <li
                      class="nav-item menu-is-opening {{ areActiveRoutes(['admin.pages.about_us.index'], 'menu-open') }}">
                      <a href="#" class="nav-link {{ areActiveRoutes(['admin.pages.about_us.index']) }}">
                          <i class="nav-icon fas fa-files"></i>
                          <p>
                              {{ __('backend.pages.pages') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: block;">
                          <li class="nav-item">
                              <a href="{{ route('admin.pages.about_us.index') }}"
                                  class="nav-link {{ areActiveRoutes(['admin.pages.about_us.index']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.pages.about_us') }}</p>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('admin.pages.show', ['page' => 'home']) }}"
                                  class="nav-link {{ areActiveRoutes(['admin.pages.show']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.pages.home') }}</p>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('admin.pages.show', ['page' => 'offers']) }}"
                                  class="nav-link {{ areActiveRoutes(['admin.pages.show']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.pages.offers') }}</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.users.index', ['view_subscriptions' => true]) }}"
                                  class="nav-link {{ areActiveRoutes(['admin.users.index']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.users.all_subscribers') }}</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Help Center --}}
                  <li
                      class="nav-item menu-is-opening {{ areActiveRoutes(['admin.help_center.subjects.index', 'admin.help_center.contacts.index'], 'menu-open') }}">
                      <a href="#"
                          class="nav-link {{ areActiveRoutes(['admin.help_center.subjects.index', 'admin.help_center.contacts.index']) }}">
                          <i class="nav-icon fas fa-help"></i>
                          <p>
                              {{ __('backend.help_center') }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: block;">
                          <li class="nav-item">
                              <a href="{{ route('admin.help_center.subjects.index') }}"
                                  class="nav-link {{ areActiveRoutes(['admin.help_center.subjects.index']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.subjects') }}</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.help_center.contacts.index') }}"
                                  class="nav-link {{ areActiveRoutes(['admin.help_center.contacts.index']) }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>{{ __('backend.contact_reqeusts') }}</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.settings.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-cogs"></i>
                          <p>
                              {{ __('backend.general_settings') }}
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
