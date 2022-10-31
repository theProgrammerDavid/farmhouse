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
        <br>
        <h3 style="color:black;">Farmer's Market</h3>
      </div>

    </div>
  </section><!-- End Cta Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <?php
            if (isset($_GET[category_id])) {
            ?>
              <li data-filter="*" class="filter-active"><?php echo $_GET[category]; ?></li>
            <?php
            } else {
            ?>
              <li data-filter="*" class="filter-active">All items</li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>

      <hr>

      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        <?php
        if (isset($_GET[submit])) {
          $sql = "SELECT * FROM product INNER JOIN seller ON product.seller_id = seller.seller_id  WHERE product.status='Active' and product.quantity>1 AND seller.state_id='$_GET[state]' and seller.country_id='$_GET[country]' and seller.city_id='$_GET[city]'";
          if (isset($_GET[category_id])) {
            $sql = $sql . " AND product.category_id='$_GET[category_id]'";
          }
          if (mysqli_num_rows($qsql)  == 0) {
            echo "<br><center>No Items to display based on location given...</center></br>";
          }
        } else {
          $sql = "SELECT * FROM product WHERE status='Active' ";
          if (isset($_GET[category_id])) {
            $sql = $sql . " AND product.category_id='$_GET[category_id]'";
          }
          $sql = $sql . " and quantity>1";
        }
        $qsql = mysqli_query($con, $sql);
        while ($rs = mysqli_fetch_array($qsql)) {
        ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="imgproduct/<?php echo $rs[img_1]; ?>" class="img-fluid" alt="" style="width: 100%;height: 300px;">
              <div class="portfolio-info">
                <h4><?php echo $rs[title]; ?></h4>
                <p><strong>Quantity :</strong> <?php echo $rs[quantity]; ?> <?php echo $rs[quantity_type]; ?></p>
                <div class="portfolio-links">
                  <a href="displaysalesdetailed.php?productid=<?php echo $rs[0]; ?>" title="More Details" class="btn btn-info"><i class="bx bx-link"></i> View More</a>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>

      </div>

    </div>
  </section><!-- End Portfolio Section -->


</main><!-- End #main -->

<?php
include("footer.php");
?>
<script type="application/javascript">
  function loadstate(id) {
    if (id == "") {
      document.getElementById("loadstate").innerHTML = "<select name='state'><option value=''>Select</option></select>";
      return;
    } else {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("loadstate").innerHTML = xmlhttp.responseText;
        }
      };
      xmlhttp.open("GET", "ajaxstate.php?id=" + id, true);
      xmlhttp.send();
    }
  }

  function loadcity(id) {
    if (id == "") {
      document.getElementById("loadcity").innerHTML = "";
      return;
    } else {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("loadcity").innerHTML = xmlhttp.responseText;
        }
      };
      xmlhttp.open("GET", "ajaxcity.php?id=" + id, true);
      xmlhttp.send();
    }
  }

  function validatesalessearch() {
    if (document.frmsalessearch.country.value == "") {
      alert("Kindly select the country to search..");
      document.frmsalessearch.country.focus();
      return false;
    } else if (document.frmsalessearch.state.value == "") {
      alert("Kindly select the state to search..");
      document.frmsalessearch.state.focus();
      return false;
    } else if (document.frmsalessearch.city.value == "") {
      alert("Kindly select the city to search..");
      document.frmsalessearch.city.focus();
      return false;
    } else {
      return true;
    }

  }
</script>