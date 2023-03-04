<header class="main-header">
  <!-- Logo -->
  <a class="logo">
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>CART
    </b></span>
  </a>
  
  <!-- Header Navbar -->
  <nav class="navbar" >
    <!-- Sidebar toggle button-->
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
         <li >
              <a >
                <img src="../m_img/<?php echo $row['m_img'];?>" width="50" height="50" class="img-circle user-image" alt="User Image">
                <span class="hidden-xs"> <?php echo $m_name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="../m_img/<?php echo $row['m_img'];?>"class="img-circle" alt="User Image user-image">
                  
                  <p>
                    พนักงาน<br>
                    
                    <small>Name : <?php echo $m_name;?>
                    </small>
                  </p>
                </li>
                <!-- Menu Body -->
                
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat" disabled>Profile</a>
                  </div>
                </li>
              </ul>
            </li>
      </ul>
    </div>

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            
        </div>
  </nav>
</header>