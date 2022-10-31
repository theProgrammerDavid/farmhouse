<?php
include("header.php");
?>


<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
       
      </div>

    </div>
  </section><!-- End Breadcrumbs -->
  

  <!-- ======= Services Section ======= -->
  <section id="services" class="services section-bg">
    <div class="container">

      <div class="row" style="justify-content:center">
        <!-- <div class="col-lg-4">
          <div class="section-title" data-aos="fade-right">
            <h2>Customer Login/Register</h2>
            <p>Login as Customer/Buyer - Buy Vegitable, Fruits, Nuts directly from Farmer... </b></p>
          </div>
        </div> -->
        <div class="col-lg-8">
          <div class="row">

            <div class="col-md-6 d-flex align-items-stretch">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="100" style="width: 100%;">
                <h4><a href="customerloginpanel.php">Existing User</a></h4>

                <button type="button" class="btn btn-info btn-lg btn-block" onclick="window.location='customerloginpanel.php'">Sign In</button>
              </div>
            </div>

            <div class="col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="200" style="width: 100%;">
                <h4><a href="customerReg.php">New User</a></h4>
                <button type="button" class="btn btn-success btn-lg btn-block" onclick="window.location='customerReg.php'">Sign Up</button>
              </div>
            </div>


          </div>
        </div>
      </div>

    </div>
  </section><!-- End Services Section -->

  <hr>
</main><!-- End #main -->

<?php
include("footer.php");
?>