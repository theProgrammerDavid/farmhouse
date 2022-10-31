<?php
include("header.php");
include("dbconnection.php");

if (isset($_GET[deleteid])) {
	$sql = "DELETE FROM selling_product WHERE selling_prod_id='$_GET[deleteid]'";
	if (!mysqli_query($con, $sql)) {
		echo "<script>alert('Failed to delete record'); </script>";
	} else {
		if (mysqli_affected_rows($con)  >= 1) {
			echo "<script>alert('This record deleted successfully..'); </script>";
		}
	}
}
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" class="cta">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3>View Farmer's Kit</h3>
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
							<h4>View Farmer's Kit records...</h4>
						</center>
						<hr>

						<?php
						$sql = "SELECT * FROM selling_product";
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no Farmer's Kit to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered" style="width:100%">
								<THEAD>
									<tr>
										<th><strong>Category</strong></th>
										<th><strong>Product Name</strong></th>
										<th><strong>Product Description</strong></th>
										<th><strong>Images</strong></th>
										<th><strong>Quantity Type</strong></th>
										<th><strong>Cost</strong></th>
										<th><strong>Status</strong></th>
										<th><strong>Action</strong></th>
									</tr>
								</THEAD>
								<TBODY>
									<?php

									while ($rs = mysqli_fetch_array($qsql)) {
										$sql1 = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
										$qsql1 = mysqli_query($con, $sql1);
										$rs1 = mysqli_fetch_array($qsql1);
										echo "
						    <tr>
						      <td>&nbsp;$rs1[category]</td>
						      <td>&nbsp;$rs[product_name]</td>
						      <td>&nbsp;$rs[product_description]</td>
						      <td>&nbsp;
								<img src='imgsellingproduct/$rs[product_img1]' width='25' height='25'>
								<hr>
								<img src='imgsellingproduct/$rs[product_img2]' width='25' height='25'>
								<hr>
								<img src='imgsellingproduct/$rs[product_img3]' width='25' height='25'>
								<hr>
							    <img src='imgsellingproduct/$rs[product_img4]' width='25' height='25'>
								<hr>
								<img src='imgsellingproduct/$rs[product_img5]' width='25' height='25'>
								</td>
								<td>&nbsp;$rs[quantity_type]</td>
						      <td>&nbsp;$rs[cost]</td>
						      <td>&nbsp;$rs[status]</td>
							  <td>&nbsp; <a href='sellingproduct.php?editid=$rs[selling_prod_id]' CLASS='btn btn-info'>Edit</a> <a href='viewsellingproduct.php?deleteid=$rs[selling_prod_id]' onclick='return delconfirm()' CLASS='btn btn-danger' >Delete</a></td>
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
		if (confirm("Are you sure you want to delete this record?") == true) {
			return true;
		} else {
			return false;
		}
	}
</script>