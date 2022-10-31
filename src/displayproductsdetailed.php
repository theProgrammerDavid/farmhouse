<?php
include("header.php");
$sql = "SELECT * FROM selling_product WHERE selling_prod_id='$_GET[productid]'";
$qsql = mysqli_query($con, $sql);
$rs = mysqli_fetch_array($qsql);
$sqlcategory = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
$qsqlcategory = mysqli_query($con, $sqlcategory);
$rscategory = mysqli_fetch_array($qsqlcategory);
?>
<style>
  .img-fluid-img {
    max-width: 100%;
    height: 300px;
  }
</style>
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Farmers Kit Product Details</h2>
        <ol>
          <li><a href="index.php">Home</a></li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="portfolio-details-container" data-aos="fade-up" data-aos-delay="100">

        <div class="owl-carousel portfolio-details-carousel">
          <?php
          $sqlslider = "SELECT * FROM selling_product WHERE selling_prod_id='$_GET[productid]'";
          $qsqlslider = mysqli_query($con, $sqlslider);
          $rsslider = mysqli_fetch_array($qsqlslider);
          ?>
          <img src="<?php echo "imgsellingproduct/" . $rsslider[product_img1]; ?>" class="img-fluid-img" alt="" style="height: 450px;">
          <?php
          if ($rsslider[product_img2] != "") {
          ?>
            <img src="<?php echo "imgsellingproduct/" . $rsslider[product_img2]; ?>" class="img-fluid-img" alt="" style="height: 450px;">
          <?php
          }
          if ($rsslider[product_img3] != "") {
          ?>
            <img src="<?php echo "imgsellingproduct/" . $rsslider[product_img3]; ?>" class="img-fluid-img" alt="" style="height: 450px;">
          <?php
          }
          if ($rsslider[product_img4] != "") {
          ?>
            <img src="<?php echo "imgsellingproduct/" . $rsslider[product_img4]; ?>" class="img-fluid-img" alt="" style="height: 450px;">
          <?php
          }
          if ($rsslider[product_img5] != "") {
          ?>
            <img src="<?php echo "imgsellingproduct/" . $rsslider[product_img5]; ?>" class="img-fluid-img" alt="" style="height: 450px;">
          <?php
          }
          ?>
        </div>

        <div class="portfolio-info">
          <h3>Product detail</h3>
          <ul>
            <li><strong>Product name</strong>: <?php echo $rs[product_name]; ?></li>
            <li><strong>Category</strong>: <?php echo $rscategory['category']; ?></li>
            <li><strong>Cost</strong>: <?php echo $rs['cost']; ?></li>
            <li><strong>Quantity</strong>: <?php echo $rs['quantity_type']; ?></li>
            <?php
            if (isset($_SESSION[customerid]) || isset($_SESSION[sellerid])) {
            ?>
              <li><a href="displaycart.php?prodid=<?php echo $rs[0]; ?>&prodcost=<?php echo $rs[cost]; ?>" class="btn btn-info">Add to Cart</a></li>
            <?php
            } else {
            ?>
              <li><a href="customerloginpanel.php?pagename=<?php echo basename($_SERVER['PHP_SELF']); ?>&productid=<?php echo $_GET[productid]; ?>" class="btn btn-warning" style="width: 100%;">Login as Customer</a></li>
              <li><a href="sellerloginpanel.php?pagename=<?php echo basename($_SERVER['PHP_SELF']); ?>&productid=<?php echo $_GET[productid]; ?>" class="btn btn-warning" style="width: 100%;">Login as Seller</a></li>
            <?php
            }
            ?>
          </ul>
        </div>

      </div>

      <div class="portfolio-description">
        <h2><?php echo $rs[product_name]; ?></h2>
        <p>
          <?php echo $rs['product_description']; ?>
        </p>
      </div>

    </div>
  </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<?php
include("footer.php");
?>