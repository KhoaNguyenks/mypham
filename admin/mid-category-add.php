<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['tcat_id'])) {
        $valid = 0;
        $error_message .= "Bạn phải chọn danh mục! <br>";
    }

    if(empty($_POST['mcat_name'])) {
        $valid = 0;
        $error_message .= "Ngành hàng không được để trống!<br>";
    }

    if($valid == 1) {

		// Saving data into the main table tbl_mid_category
		$statement = $pdo->prepare("INSERT INTO tbl_mid_category (mcat_name,tcat_id) VALUES (?,?)");
		$statement->execute(array($_POST['mcat_name'],$_POST['tcat_id']));
	
    	$success_message = 'Ngành hàng được thêm thành công!';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Thêm ngành hàng</h1>
	</div>
	<div class="content-header-right">
		<a href="mid-category.php" class="btn btn-primary btn-sm">Xem tất cả</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php if($error_message): ?>
			<div class="callout callout-danger">
			
			<p>
			<?php echo $error_message; ?>
			</p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
			
			<p><?php echo $success_message; ?></p>
			</div>
			<?php endif; ?>

			<form class="form-horizontal" action="" method="post">

				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Danh mục <span>*</span></label>
							<div class="col-sm-4">
								<select name="tcat_id" class="form-control select2">
									<option value="">Chọn danh mục</option>
									<?php
									$statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_name ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
									foreach ($result as $row) {
										?>
										<option value="<?php echo $row['tcat_id']; ?>"><?php echo $row['tcat_name']; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Ngành hàng <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="mcat_name">
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Hoàn thành</button>
							</div>
						</div>
					</div>
				</div>

			</form>


		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>