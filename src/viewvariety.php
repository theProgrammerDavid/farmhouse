<?php
include("header.php");
include("dbconnection.php");

if (isset($_GET[deleteid])) {
	$sql = "DELETE FROM variety WHERE variety_id='$_GET[deleteid]'";
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
				<h3><?php echo "View " . $_GET[varietytype] . " Variety"; ?></h3>
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
							<h4><?php echo "View " . $_GET[varietytype] . " Variety"; ?> list...</h4>
						</center>
						<hr>

						<?php
						$sql = "SELECT * FROM variety";
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no variety to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered" style="width:100%">
								<THEAD>
									<tr>
										<th width="155"><strong>Category</strong></th>
										<th width="133"><strong>Produce</strong></th>
										<th width="121"><strong>Variety</strong></th>
										<th width="232"><strong>Description</strong></th>
										<th width="81"><strong>Image</strong></th>
										<th width="88"><strong>Status</strong></th>
										<th width="99"><strong>Action</strong></th>
									</tr>
								</THEAD>
								<TBODY>
									<?php
									$sql = "SELECT * FROM variety INNER JOIN category ON variety.category_id=category.category_id WHERE category_type='$_GET[varietytype]'";
									$qsql = mysqli_query($con, $sql);
									while ($rs = mysqli_fetch_array($qsql)) {
										$sqlcategory = "SELECT * FROM category where category_id='$rs[category_id]'";
										$qsqlcategory = mysqli_query($con, $sqlcategory);
										$rscategory = mysqli_fetch_array($qsqlcategory);

										$sqlproduce = "SELECT * FROM produce where produce_id='$rs[produce_id]'";
										$qsqlproduce = mysqli_query($con, $sqlproduce);
										$rsproduce = mysqli_fetch_array($qsqlproduce);
										echo "
						    <tr>
						      <td>&nbsp;$rscategory[category]</td>
						      <td>&nbsp;$rsproduce[produce]</td>
						      <td>&nbsp;$rs[variety]</td>
						      <td>&nbsp;$rs[4]</td>
						       <td>&nbsp;
								<img src='imgvariety/$rs[5]' width='25' height='25'>
								</td>
						      <td>&nbsp;$rs[status]</td>
							  <td>&nbsp;<a href='variety.php?editid=$rs[variety_id]' CLASS='btn btn-info'>Edit</a> |  <a href='viewvariety.php?deleteid=$rs[variety_id]' onclick='return delconfirm()' CLASS='btn btn-danger'>Delete</a></td>
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