<?php session_start(); ?>
<?php include('h.php');?>



<?php 

?>



<body>

<style>

  body {

    background-color: #ffffe0;

  }

  

</style>

</body>

<div class="col-md-12" style="width: 1500px;">





    <?php include('navbar.php');?>




      </div>

      <div class="col-md-6">

      <?php

      $act = (isset($_GET['act']) ? $_GET['act']:'');

      $q = (isset($_GET['q']) ? $_GET['q']:'');

      if($act == 'showbytype'){

        



        include('show_product_type.php');

      }else{

       include('show_product.php'); 

       }

       ?>

      

      </div>

      <div class="col-md-6">



        <?php include('cart.php'); ?>



      </div>

    </div>



  </div>

</div>





</html>
     <div class="col-md-12">
<?php include('footer.php');?>
</div>

</div>


</html>

