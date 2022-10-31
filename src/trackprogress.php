<?php
if (!isset($_SESSION)) {
  session_start();
}
include("dbconnection.php");
if (!isset($_SESSION[sellerid])) {
  echo "<script>window.location='sellerloginpanel.php';</script>";
}
include("header.php");
if (isset($_SESSION[sellerid])) {
  $sql = "SELECT * FROM seller WHERE seller_id='$_SESSION[sellerid]'";
  $qsql = mysqli_query($con, $sql);
  $rsdisp = mysqli_fetch_array($qsql);
}
?>
<main id="main">


  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container">

      <div class="text-center" data-aos="zoom-in">
        <br><br>
        <h3>Keep Track of Your Progress...</h3>
      </div>

    </div>
  </section><!-- End Cta Section -->




</main><!-- End #main -->
<?php include("footer.php"); ?>