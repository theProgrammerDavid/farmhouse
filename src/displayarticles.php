<?php
include("header.php");
?>


<main id="main">
  <!-- ======= Cta Section ======= -->
  <section id="cta" style="padding-bottom:0px;">
    <div class="container">

      <div class="text-center" data-aos="zoom-in">
        <br>
        <br>
        <h3>Latest <?php echo $_GET[articletype]; ?></h3>
      </div>

    </div>
  </section><!-- End Cta Section -->


  <!-- ======= Team Section ======= -->
  <section id="team" class="team">
    <div class="container">

      <div class="row">

        <div class="col-lg-12">
          <div class="row">

            <?php
            $sql = "SELECT * FROM article WHERE article_type='$_GET[articletype]' order by article_id desc  ";
            $qsql = mysqli_query($con, $sql);
            while ($rs = mysqli_fetch_array($qsql)) {
            ?>
              <div class="col-lg-4">
                <div class="member" data-aos="zoom-in" data-aos-delay="100">
                  <div class=""><a href='displayarticlesdetailed.php?articleid=<?php echo $rs[article_id]; ?>'><?php echo "<img src='imgarticle/$rs[article_img1]' align='left' width='100%' height='150' style='padding-right: 10px;'>"; ?></a></div>
                  <div class="member-info">
                    <h4><a href='displayarticlesdetailed.php?articleid=<?php echo $rs[article_id]; ?>'><?php echo $rs[title]; ?></a></h4>
                    <span>Published on - <?php echo date("d-M-Y", strtotime($rs[publish_date])); ?></span>
                    <a href="displayarticlesdetailed.php?articleid=<?php echo $rs[article_id]; ?>" class="btn btn-info">Read More..</a>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>

        </div>
      </div>

    </div>
  </section><!-- End Team Section -->

</main><!-- End #main -->

<?php
include("footer.php");
?>