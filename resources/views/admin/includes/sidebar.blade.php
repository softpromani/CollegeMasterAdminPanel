  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <!-- Dashboard -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.index') ? '' : 'collapsed' }}" href="{{ route('admin.dashboard') }}">
                  <i class="bi bi-grid"></i>
                  <span>{{ __('college-admin::messages.dashboard') }}</span>
              </a>
          </li><!-- End Dashboard Nav -->

          <!-- Users -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.user.*') ? '' : 'collapsed' }}" href="{{ route('admin.user.index') }}">
                  <i class="bi bi-person"></i>
                  <span>{{ __('college-admin::messages.users') }}</span>
              </a>
          </li>

          <!-- Notices -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.notice.*') ? '' : 'collapsed' }}" href="{{ route('admin.notice.index') }}">
                  <i class="bi bi-megaphone"></i>
                  <span>{{ __('college-admin::messages.notices') }}</span>
              </a>
          </li>

          <!-- Events -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.event.*') || request()->routeIs('admin.event.gallery*') ? '' : 'collapsed' }}" href="{{ route('admin.event.index') }}">
                  <i class="bi bi-calendar-event"></i>
                  <span>{{ __('college-admin::messages.events') }}</span>
              </a>
          </li>

          <!-- Banners -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.banner.*') ? '' : 'collapsed' }}" href="{{ route('admin.banner.index') }}">
                  <i class="bi bi-images"></i>
                  <span>{{ __('college-admin::messages.banner') }}</span>
              </a>
          </li>

          <!-- Inquiries -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.contact-inquiries.*') ? '' : 'collapsed' }}" href="{{ route('admin.contact-inquiries.index') }}">
                  <i class="bi bi-chat-left-text"></i>
                  <span>Inquiries</span>
                  @php
                      $unreadInquiries = \CollegeAdmin\Models\Contact::where('status', 'unread')->count();
                  @endphp
                  @if($unreadInquiries > 0)
                      <span class="badge bg-danger rounded-pill ms-auto">{{ $unreadInquiries }}</span>
                  @endif
              </a>
          </li>

          <!-- Role & Permission Dropdown -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') || request()->routeIs('admin.roles.permission*') ? '' : 'collapsed' }}"
                 data-bs-target="#role-permission-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-shield-lock"></i>
                  <span>{{ __('college-admin::messages.role_permission') }}</span>
                  <i class="bi bi-chevron-down ms-auto"></i>
              </a>

              <ul id="role-permission-nav"
                  class="nav-content collapse {{ request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') || request()->routeIs('admin.roles.permission*') ? 'show' : '' }}"
                  data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.roles.index') }}" class="{{ request()->routeIs('admin.roles.index') || request()->routeIs('admin.roles.create') || request()->routeIs('admin.roles.edit') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i>
                          <span>{{ __('college-admin::messages.roles') }}</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.permissions.index') }}" class="{{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i>
                          <span>{{ __('college-admin::messages.permissions') }}</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.roles.permission') }}" class="{{ request()->routeIs('admin.roles.permission*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i>
                          <span>{{ __('college-admin::messages.role_has_permission') }}</span>
                      </a>
                  </li>
              </ul>
          </li>

          <!-- AQAR Dropdown -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.aqar.*') || request()->routeIs('admin.aqar-session.*') || request()->routeIs('admin.aqar-criteria.*') ? '' : 'collapsed' }}"
                 data-bs-target="#aqar-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-award"></i>
                  <span>{{ __('college-admin::messages.aqar') }}</span>
                  <i class="bi bi-chevron-down ms-auto"></i>
              </a>

              <ul id="aqar-nav"
                  class="nav-content collapse {{ request()->routeIs('admin.aqar.*') || request()->routeIs('admin.aqar-session.*') || request()->routeIs('admin.aqar-criteria.*') ? 'show' : '' }}"
                  data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.aqar.index') }}" class="{{ request()->routeIs('admin.aqar.*') || request()->routeIs('admin.aqar-criteria.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i>
                          <span>Criteria Wise</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.aqar-session.index') }}" class="{{ request()->routeIs('admin.aqar-session.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i>
                          <span>Session Wise</span>
                      </a>
                  </li>
              </ul>
          </li>

          <!-- Faculty & Department Dropdown -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.department.*') || request()->routeIs('admin.subject-department.*') || request()->routeIs('admin.faculty.*') ? '' : 'collapsed' }}"
                 data-bs-target="#faculty-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-people"></i>
                  <span>{{ __('college-admin::messages.faculty') }}</span>
                  <i class="bi bi-chevron-down ms-auto"></i>
              </a>

              <ul id="faculty-nav"
                  class="nav-content collapse {{ request()->routeIs('admin.department.*') || request()->routeIs('admin.subject-department.*') || request()->routeIs('admin.faculty.*') ? 'show' : '' }}"
                  data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.department.index') }}" class="{{ request()->routeIs('admin.department.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i>
                          <span>{{ __('college-admin::messages.department') }}</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.subject-department.index') }}" class="{{ request()->routeIs('admin.subject-department.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i>
                          <span>{{ __('college-admin::messages.subject_department') }}</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.faculty.index') }}" class="{{ request()->routeIs('admin.faculty.index') || request()->routeIs('admin.faculty.create') || request()->routeIs('admin.faculty.edit') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i>
                          <span>{{ __('college-admin::messages.faculty') }}</span>
                      </a>
                  </li>
              </ul>
          </li>

          <!-- Non-Faculty -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.non-faculty.*') ? '' : 'collapsed' }}" href="{{ route('admin.non-faculty.index') }}">
                  <i class="bi bi-person-badge"></i>
                  <span>{{ __('college-admin::messages.non_faculty') }}</span>
              </a>
          </li>

          <li class="nav-heading">{{ __('college-admin::messages.settings') }}</li>

          <!-- Profile -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.profile.index') ? '' : 'collapsed' }}" href="{{ route('admin.profile.index') }}">
                  <i class="bi bi-person-circle"></i>
                  <span>{{ __('college-admin::messages.profile') }}</span>
              </a>
          </li>

          <!-- System & Updates -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.system.*') ? '' : 'collapsed' }}" href="{{ route('admin.system.updates') }}">
                  <i class="bi bi-arrow-repeat"></i>
                  <span>{{ __('college-admin::messages.system_updates') }}</span>
              </a>
          </li>

      </ul>

  </aside>