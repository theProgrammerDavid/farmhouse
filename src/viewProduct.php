<?php
include("header.php");
include("dbconnection.php");
if (isset($_GET[deleteid])) {
	$sql = "DELETE FROM product WHERE product_id='$_GET[deleteid]'";
	if (!mysqli_query($con, $sql)) {
		echo "<script>alert('Failed to delete record'); </script>";
	} else {
		if (mysqli_affected_rows($con)  >= 1) {
			echo "<script>alert('This record deleted successfully..'); </script>";
		}
	}
}


$sql1 = "update product set status='Inactive' WHERE quantity='0'";
$qsql1 = mysqli_query($con, $sql1);

$sql1 = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
$qsql1 = mysqli_query($con, $sql1);
$rs1 = mysqli_fetch_array($qsql1);
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" style="padding-bottom:0px;">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3 style="color:black;">View Product</h3>
			</div>

		</div>
	</section><!-- End Cta Section -->


	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container">
			<div class="row">


				<div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
					<div class="info mt-4 ">

						<center>
							<h4>View Product Detail...</h4>
						</center>
						<hr>

						<?php
						$sql = "SELECT * FROM product ";
						if (isset($_SESSION[sellerid])) {
							$sql = $sql . " WHERE seller_id='$_SESSION[sellerid]'";
						}
						$sql = $sql . " ORDER BY product_id DESC";
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no Farm Produce to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered" style="width:100%">
								<THEAD>
									<tr>
										<th width="103"><strong>Category</strong></th>
										<th width="89"><strong>Produce</strong></th>
										<th width="81"><strong>Variety</strong></th>
										<th width="52"><strong>Title</strong></th>
										<th width="83"><strong>Images</strong></th>
										<th width="97"><strong>Quantity</strong></th>
										<th width="92"><strong>Upload Date</strong></th>
										<th width="57"><strong>Status</strong></th>
										<th width="102"><strong>Action</strong></th>
									</tr>
								</THEAD>
								<TBODY>
									<?php
									$sql = "SELECT * FROM product";
									if (isset($_SESSION[sellerid])) {
										$sql = $sql . " WHERE seller_id='$_SESSION[sellerid]'";
									}
									$qsql = mysqli_query($con, $sql);
									while ($rs = mysqli_fetch_array($qsql)) {
										$sql1 = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
										$qsql1 = mysqli_query($con, $sql1);
										$rs1 = mysqli_fetch_array($qsql1);

										$sql2 = "SELECT * FROM produce WHERE produce_id='$rs[produce_id]'";
										$qsql2 = mysqli_query($con, $sql2);
										$rs2 = mysqli_fetch_array($qsql2);

										$sql3 = "SELECT * FROM variety WHERE variety_id='$rs[variety_id]'";
										$qsql3 = mysqli_query($con, $sql3);
										$rs3 = mysqli_fetch_array($qsql3);

										echo "
						    <tr>
						      <td>&nbsp;$rs1[category]</td>
						      <td>&nbsp;$rs2[produce]</td>
						      <td>&nbsp;$rs3[variety]</td>
						      <td>&nbsp;$rs[title]</td>
						       <td>&nbsp;
								<img src='imgproduct/$rs[img_1]' width='25' height='25'>
								&nbsp;
								<img src='imgproduct/$rs[img_2]' width='25' height='25'>
								&nbsp;
								<img src='imgproduct/$rs[img_3]' width='25' height='25'>
								&nbsp;
							    <img src='imgproduct/$rs[img_4]' width='25' height='25'>
								&nbsp;
								<img src='imgproduct/$rs[img_5]' width='25' height='25'>
								</td>
						      <td>&nbsp;$rs[quantity]&nbsp;$rs[quantity_type]</td>
						
						      <td>&nbsp;$rs[uploaded_date]</td>
						      <td>&nbsp;$rs[status]</td>
							   <td><a href='Product.php?editid=$rs[product_id]' class='btn btn-info'>Edit</a> | <a href='viewProduct.php?deleteid=$rs[product_id]' onclick='return delconfirm()' class='btn btn-danger'>Delete</a></td>
					        </tr>";
									}
									?>
								</TBODY>
							</table>
						<?php
						}
						?>
					</div>
				</div>

			</div>

		</div>
	</section><!-- End Contact Section -->

</main><!-- End #main -->

<?php
include("footer.php");
?>
<script type="application/javascript">
	function delconfirm() {
		if (confirm("Are you sure want to delete this record?") == true) {
			return true;
		} else {
			return false;
		}
	}
</script>