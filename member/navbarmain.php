<nav class="navbar navbar-expand-lg navbar-light " style="background-color:bisque;">
  <a class="navbar-brand">Koi Cafe</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="saleproduct.php"><i class="fa fa-shopping-cart"></i>
        <span id="cart-item" class="badge badge-danger"></span>เข้าสู่ระบบขายสินค้า</a></a>
      </li>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp



      <li class="nav-item active">
        <a class="nav-link" href="history.php"><i class="fa fa-calendar"></i>
        <span id="cart-item" class="badge badge-danger"></span>ประวัติการขาย</a>
      </li>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <li class="nav-item active">
        <a class="nav-link" a href="../logout.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');"><i class="fas fa-sign-out-alt"></i>
        <span id="cart-item" class="badge badge-danger"></span>ออกจากระบบ</a></a>
      </li>
    </ul>
  </div>
  <form class="form-inline my-2 my-lg-0" action="index.php" method="GET" align="right">
  <div class="pull-left image" >
      <a >
                <span class="hidden-xs"> ยินดีต้อนรับ</span>
              </a>
  <li >


              <a >
                <span class="hidden-xs">คุณ <?php echo $m_name; ?></span>
              </a>
      </div>
    </form>
</nav>