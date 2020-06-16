<?php require_once("./bootstrap.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>URL Shortner</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<div class="row justify-content-center">
		<div class="col-md-6 ">
			<div class="card mt-5" >
			  <div class="card-body">
			    <h5 class="card-title text-center">Generate Short URL</h5>
				   	<form id="url-form">
				   		  <div class="row">
						    <div class="col-md-9">
						      <input id="url" type="text" name="url" class="form-control" placeholder="Enter URL">
						    </div>
						    <div class="col-md-3">
						      <input type="submit" class="btn btn-primary" value="Generate" >
						    </div>
						  </div>
					</form>
					<a href="<?php echo BASE_URL.'log.php'; ?>" class="btn btn-primary btn-sm mt-5" >Show Logs</a>
			  </div>
			</div>
			<div class="card short-url-view mt-5 " style="display: none;">
				<div class="card-body">
					 <h5 class="card-title text-center">Short Url</h5>
					 <div class="row">
					 	<div class="col-md-12">
					 		<p class="short-url-para" style="line-height: 35px; margin: 0px 10px; border-radius: 5px; padding: 0px 10px; background: #cfd8dc; border: 2px solid #ddd;"></p>
					 	</div>
					 </div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/jquery.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<script>
	$("#url-form").on("submit", function(e){
		$(".short-url-view").hide();
		e.preventDefault();
		var url = $("#url").val();
		if(!url) {
			Swal.fire({
			  title: 'Error!',
			  text: 'Please enter url',
			  icon: 'error',
			  confirmButtonText: 'Ok'
			});
			return;
		}
		$.ajax({
			url: "action.php",
			method: "post",
			data: {url: url},
			success: function(data) {
				data = JSON.parse(data);
				if(data.error) {
					Swal.fire({
					  title: 'Error!',
					  text: data.error,
					  icon: 'error',
					  confirmButtonText: 'Ok'
					});
					return;
				}
				$("#url").val("");
				$(".short-url-para").text(data.shortUrl);
				$(".short-url-view").show();
			}
		})
	});
	</script>
</body>
</html>