  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link " href="{{route('admin.dashboard')}}">
                  <i class="bi bi-grid"></i>
                  <span>{{ __('messages.dashboard') }}</span>
              </a>
          </li><!-- End Dashboard Nav -->


          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.user.index') }}">
                  <i class="bi bi-person"></i>
                  <span>{{ __('messages.users') }}</span>
              </a>
          </li>

              <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.notice.index') }}">
                  <i class="bi bi-megaphone"></i>
                  <span>{{ __('messages.notices') }}</span>
              </a>
          </li>

            <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.event.index') }}">
                  <i class="bi bi-calendar-event"></i>
                  <span>{{ __('messages.events') }}</span>
              </a>
          </li>
    <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.banner.index') }}">
                  <i class="bi bi-images"></i>
                  <span>{{ __('messages.banner') }}</span>
              </a>
          </li>









          <li class="nav-item">

              <a class="nav-link collapsed" data-bs-target="#role-permission-nav" data-bs-toggle="collapse"
                  href="#">

                  <i class="bi bi-shield-lock"></i>

                  <span>{{ __('messages.role_permission') }}</span>

                  <i class="bi bi-chevron-down ms-auto"></i>

              </a>

              <ul id="role-permission-nav"
                  class="nav-content collapse
                {{ request()->routeIs('admin.roles.*') ||
                request()->routeIs('admin.permissions.*') ||
                request()->routeIs('admin.role.permission')
                    ? 'show'
                    : '' }}"
                  data-bs-parent="#sidebar-nav">

                  <li>

                      <a href="{{ route('admin.roles.index') }}">

                          <i class="bi bi-circle"></i>

                          <span>{{ __('messages.roles') }}</span>

                      </a>

                  </li>

                  <li>

                      <a href="{{ route('admin.roles.permission') }}">

                          <i class="bi bi-circle"></i>

                          <span>{{ __('messages.role_has_permission') }}</span>

                      </a>

                  </li>

              </ul>

          </li>


              <li class="nav-item">

              <a class="nav-link collapsed" data-bs-target="#aqar" data-bs-toggle="collapse"
                  href="#">

                  <i class="bi bi-shield-lock"></i>

                  <span>{{ __('messages.aqar') }}</span>

                  <i class="bi bi-chevron-down ms-auto"></i>

              </a>

              <ul id="aqar"
                  class="nav-content collapse"
                  data-bs-parent="#aqar">

                  <li>

                      <a href="{{ route('admin.aqar.index') }}">

                          <i class="bi bi-circle"></i>

                          <span>Criteria Wise</span>

                      </a>

                  </li>

                  <li>

                      <a href="{{ route('admin.aqar-session.index') }}">

                          <i class="bi bi-circle"></i>

                          <span>Session Wise</span>

                      </a>

                  </li>

              </ul>

          </li>


          <li class="nav-item">

              <a class="nav-link collapsed" data-bs-target="#faculty" data-bs-toggle="collapse"
                  href="#">

                  <i class="bi bi-shield-lock"></i>

                  <span>{{ __('messages.faculty') }}</span>

                  <i class="bi bi-chevron-down ms-auto"></i>

              </a>

              <ul id="faculty"
                  class="nav-content collapse"
                  data-bs-parent="#faculty">
              <li>

                      <a href="{{ route('admin.department.index') }}">

                          <i class="bi bi-circle"></i>

                          <span>{{ __('messages.department') }}</span>

                      </a>

                  </li>

                  <li>

                      <a href="{{ route('admin.subject-department.index') }}">

                          <i class="bi bi-circle"></i>

                          <span>{{ __('messages.subject') }}</span>

                      </a>

                  </li>

                             <li>

                      <a href="{{ route('admin.faculty.index') }}">

                          <i class="bi bi-circle"></i>

                          <span>{{ __('messages.faculty') }}</span>

                      </a>

                  </li>
              </ul>

          </li>


            <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.non-faculty.index') }}">
                  <i class="bi bi-person"></i>
                  <span>{{ __('messages.non_faculty') }}</span>
              </a>
          </li>


      </ul>

  </aside><!-- End Sidebar-->
