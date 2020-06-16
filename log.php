<?php
	require_once("./bootstrap.php");
	$logs = getLogs();

?>
<!DOCTYPE html>
<html>
<head>
	<title>URL Shortner</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-5">
		<div class="card mt-5" >
			<div class="card-body">
			   	<h5 class="card-title text-center">Client logs</h5>
			   	<a href="<?php echo BASE_URL ?>">Go Back</a>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th>#</th>
								<th>URL</th>
								<th>Short URL</th>
								<th>Client IP</th>
								<th>Timestamp</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($logs as $key => $log) { ?>
							<tr>
								<td><?php echo $key+ 1; ?></td>
								<td><?php echo $log["url"]; ?></td>
								<td><?php echo BASE_URL."go.php/?code=".$log["code"]; ?></td>
								<td><?php echo $log["client_ip"]; ?></td>
								<td><?php echo $log["logged_at"]; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/jquery.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>