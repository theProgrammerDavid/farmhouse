<?php
include("header.php");
include("dbconnection.php");

if (isset($_GET[deleteid])) {
	$sql = "DELETE FROM state WHERE state_id='$_GET[deleteid]'";
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
				<h3>View state</h3>
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
							<h4>View state records...</h4>
						</center>
						<hr>

						<?php
						$sql = "SELECT * FROM state";
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no State to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered ">
								<thead>
									<tr>
										<th><strong>Country</strong></th>
										<th><strong>State</strong></th>
										<th><strong>Description</strong></th>
										<th><strong>Status</strong></th>
										<th><strong>Action</strong></th>
									</tr>
								</thead>
								<tbody>
									<?php

									while ($rs = mysqli_fetch_array($qsql)) {
										$sql1 = "SELECT * FROM country WHERE country_id='$rs[country_id]'";
										$qsql1 = mysqli_query($con, $sql1);
										$rs1 = mysqli_fetch_array($qsql1);
										echo "
  <tr>
	<td>&nbsp;$rs1[country]</td>
	<td>&nbsp;$rs[state]</td>
	<td>&nbsp;$rs[description]</td>
	<td>&nbsp;$rs[status]</td>
	 <td>&nbsp; <a href='state.php?editid=$rs[state_id]' CLASS='btn btn-info'>Edit</a>  <a href='viewstate.php?deleteid=$rs[state_id]' onclick='return delconfirm()' CLASS='btn btn-danger'>Delete</a></td>
  </tr>";
									}
									?>
								</tbody>
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