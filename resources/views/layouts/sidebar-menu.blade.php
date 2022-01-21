<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt blue"></i>
          <p>
            Dashboard
          </p>
        </router-link>
      </li> 
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog green"></i>
          <p>
            SUH
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <router-link to="/AddSuh" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Add SUH
              </p>
            </router-link>
          </li>
        <li class="nav-item">
            <router-link to="/ListSuh" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                List of SUH
              </p>
            </router-link>
          </li>
         
        </ul>
      </li>

      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog green"></i>
          <p>
            Inmates
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
              <router-link to="#" class="nav-link">
                <i class="nav-icon fas fa-list-ol green"></i>
                <p>
                  Add Inmates
                </p>
              </router-link>
            </li>
           
          <li class="nav-item">
            <router-link to="#" class="nav-link">
              <i class="fa fa-users nav-icon blue"></i>
              <p>List of Inmates</p>
            </router-link>
          </li>
          </ul>
      </li>




    

      
{{-- 
      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog green"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <router-link to="/setting/loanperiod" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Loan Period
              </p>
            </router-link>
          </li>
        <li class="nav-item">
            <router-link to="/setting/loantype" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Loan Type
              </p>
            </router-link>
          </li>
          @can('isAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="fa fa-users nav-icon blue"></i>
            <p>Users</p>
          </router-link>
        </li>
      @endcan
  
        </ul>
      </li>

      @endcan
       --}}
      

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>