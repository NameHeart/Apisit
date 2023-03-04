 <aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../m_img/<?php echo $m_img; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>คุณ <?php echo $m_name; ?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
        <li>
        <a href="index.php"><i class="fa fa-home"></i>
          <span> หน้าหลัก</span>
        </a>
      </li>
      
           <li class="active">
        <a ><i class="fa fa-cogs"></i> <span>จัดการข้อมูลระบบ</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-down pull-right"></i>
        </span>
      </a>
    </li>
    
      <li>
        <a href="member.php"><i class="fa fa-cog"></i>
          <span> จัดการสมาชิก</span>
        </a>
      </li>
      <li>
        <a href="type.php"><i class="fa fa-cog"></i>
          <span> จัดการประเภท </span>
        </a>
      </li>
      <li>
        <a href="product.php"><i class="fa fa-cog"></i>
          <span> จัดการสินค้า </span>
        </a>
      </li>
        <li>
        <a href="member_profile.php"><i class="fa fa-cog"></i>
          <span> แก้ไขข้อมูลส่วนตัว </span>
        </a>
      </li>
           
      <li class="active" >
        <a ><i class="fas fa-shopping-cart"></i></i> <span>ตรวจสอบรายได้ของร้าน</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-down pull-right"></i>
        </span>
      </a>
    </li>
    <li >
        <a href="r_dailydetail.php"><i class="fas fa-money-bill-alt"></i> <span>ข้อมูลรายละเอียดรายได้</span>
      </a>
    </li>
    <li >
        <a href="r_daily.php"><i class="fas fa-money-bill-alt"></i> <span>ข้อมูลรายได้ต่อวันของร้าน</span>
      </a>
    </li>
    <li>
        <a href="r_monthy.php"><i class="fas fa-money-bill-alt"></i> <span>ข้อมูลรายได้ต่อเดือนของร้าน</span>
      </a>
    </li>
    <li >
        <a href="r_yearly.php"><i class="fas fa-money-bill-alt"></i> <span>ข้อมูลรายได้ต่อปีของร้าน</span>
      </a>
    </li>
    <li >
        <a href="member_summary.php"><i class="fas fa-money-bill-alt"></i> <span>ข้อมูลยอดขายของพนักงาน</span>
      </a>
    </li>
    <li class="active" >
        <a ><i class="fas fa-shopping-cart"></i></i> <span>ตรวจสอบยอดขายของสินค้า</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-down pull-right"></i>
        </span>
      </a>
    </li>
    <li >
        <a href="summaryproduct.php"><i class="fa fa-coffee"></i> <span>ข้อมูลยอดขายสินค้า</span>
      </a>
    </li>
    <li >
        <a href="bestsale.php"><i class="fa fa-coffee"></i> <span>สินค้าขายดี5อันดับ</span>
      </a>
    </li>
    <li >
        <a href="typesummary.php"><i class="fa fa-coffee"></i> <span>ข้อมูลยอดขายของประเภทสินค้า</span>
      </a>
    </li>
    <li >
        <a href="order_detail.php"><i class="fa fa-coffee"></i> <span>ข้อมูลรายละเอียดของออเดอร์</span>
      </a>
    </li>
    


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>