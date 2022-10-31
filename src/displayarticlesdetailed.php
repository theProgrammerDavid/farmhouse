<?php
include("header.php");
$sql = "SELECT * FROM article where article_id='$_GET[articleid]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);
?>

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="text-center" data-aos="zoom-in">
		<br>
		<br>
		<br>
          <h3><?php echo $rs[title]; ?></h3>
		  <p>Published on <?php echo date("d-M-Y",strtotime($rs[publish_date])); ?></p>
        </div>

      </div>
    </section><!-- End Cta Section -->

  <main id="main">



    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-12 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200">
            <p class="font-italic">
			<img src="imgarticle/<?php echo $rs[article_img1]; ?>" style="width: 500px; padding: 10px;" align="left">
			<?php echo $rs[article_description]; ?></p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->



    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-6 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
<?php
if($rs[article_img2] != "" && file_exists('imgarticle/'.$rs[article_img2]))
{
echo "<img src='imgarticle/$rs[article_img2]'  class='img-fluid' align='left' style='padding-right: 10px;width: 100%;'>";
}
?>
            </div>
          </div>


          <div class="col-lg-6 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
<?php
if($rs[article_img3] != "" && file_exists('imgarticle/'.$rs[article_img3]))
{
echo "<img src='imgarticle/$rs[article_img3]'  class='img-fluid' align='left' style='padding-right: 10px;width: 100%;'>";
}
?>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
<?php
if($rs[article_img4] != "" && file_exists('imgarticle/'.$rs[article_img4]))
{
echo "<img src='imgarticle/$rs[article_img4]'  class='img-fluid' align='left' style='padding-right: 10px;width: 100%;'>";
}
?>
            </div>
          </div>


          <div class="col-lg-6 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
<?php
if($rs[article_img5] != "" && file_exists('imgarticle/'.$rs[article_img5]))
{
echo "<img src='imgarticle/$rs[article_img5]'  class='img-fluid' align='left' style='padding-right: 10px;width: 100%;'>";
}
?>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->


  </main><!-- End #main -->
  
<?php
include("footer.php");
?>