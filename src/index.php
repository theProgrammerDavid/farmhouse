<?php
include("header.php");
?>



<main id="main">

  <!-- ======= Clients Section ======= -->


  <br />
  <br />
  <br />

  <!-- ======= Why Us Section ======= -->
  <section id="why-us" class="why-us">
    <div class="container">

      <div class="row">

        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="icon-boxes d-flex flex-column justify-content-center" style="width:100%" >
            <div class="row" style="justify-content: center">

              <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100" style="min-width:15rem;">
                <div class="icon-box mt-4 mt-xl-0" style="width: fit-content;">
                  <h4>Customer</h4>
                  <b style="white-space: nowrap;">Login / Register as Customer</b>
                  <br>
                  <br>
                  <!-- <p>Are you willing to purchase products from Farmer's?<br> <b>Login / Register as Customer</b></p> -->
                  <div class="text-center"><button type="button" class="btn btn-info" onclick="window.location='customerreglogin.php'">Click Here</button></div>
                </div>
              </div>

              <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200" style="min-width:15rem;">
                <div class="icon-box mt-4 mt-xl-0" style="width: fit-content;">
                  <h4>Farmer</h4>
                  <b style="white-space: nowrap;">Login / Register as Farmer</b>
                  <br>
                  <br>
                  <!-- <p>Online Market where you can Sell fruits & vegetables, agri produce, etc...<br>
                    <b>Login / Register as Farmer</b>
                  </p> -->
                  <div class="text-center"><button type="button" class="btn btn-info" onclick="window.location='farmerreglogin.php'">Click Here</button></div>
                </div>
              </div>

            </div>
          </div><!-- End .content-->
        </div>
      </div>

    </div>
  </section><!-- End Why Us Section -->


</main><!-- End #main -->

<?php
include("footer.php");
?>