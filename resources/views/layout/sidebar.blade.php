  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src="{{url('frontend/images/main_hor_white.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{session()->get('name')}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @if (session()->get('role')=='admin')
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{route('ticket.index')}}" class="nav-link">
                <i class="nav-icon  fas fa-ticket-alt"></i>
                <p>
                  Tickets
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('agent.index')}}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Agents
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas far fa-comments"></i>
                <p>
                  Chat Request
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{route('email.index')}}" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                  Emails
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('question.index')}}" class="nav-link">
                <i class="nav-icon  fas fa-question"></i>
                <p>
                  Knowldege Base
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
          </ul>
        </nav>
        @elseif (session()->get('role')=='agent')
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{route('ticket.index')}}" class="nav-link">
                <i class="nav-icon  fas fa-ticket-alt"></i>
                <p>
                  Tickets
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('question.index')}}" class="nav-link">
                <i class="nav-icon  fas fa-question"></i>
                <p>
                  Knowldege Base
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
          </ul>
        </nav>
      @elseif (session()->get('role')=='user')
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('/services')}}" class="nav-link">
              <i class="nav-icon  fas fa-cubes"></i>
              <p>
                Services
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('ticket.index')}}" class="nav-link">
              <i class="nav-icon  fas fa-ticket-alt"></i>
              <p>
                Tickets
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Invoices
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('question.index')}}" class="nav-link">
              <i class="nav-icon  fas fa-question"></i>
              <p>
                Knowldege Base
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
        </ul>
      </nav>
    @endif
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>