<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>PDF File Upload</title>


</head>
<body>
	<h1 class="text-center">PDF Upload</h1>
	<div class="container">

		<div class="alert" id="message" style="display: none"></div>
		<form method="post" id="upload_form" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">
				<table class="table">
					<tr>
						<td width="40%" align="right"><label>Select File for Upload</label></td>
						<td width="30"><input type="file" name="select_file" required="true" id="select_file" /></td>
						<td width="30%" align="left"><input type="submit" name="upload"  id="upload" class="btn btn-primary" value="Upload"></td>
					</tr>
					
				</table>
			</div>
		</form>
		<br />
		<span id="uploaded_image"></span>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>

	<script type="text/javascript">		

		$('#upload_form').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url:"{{ route('ajaxupload.action') }}",
				method:"POST",
				data: new FormData(document.querySelector('form')),
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data)
				{
					$("#select_file").val(null);
					$('#message').css('display', 'block');
					$('#message').html(data.message);
					$('#message').addClass(data.class_name);
					
				},
				error: function(jqXhr, json, errorThrown){
					var data = jqXhr.responseJSON;
					$('#message').css('display', 'block');
					$('#message').html(data.message);
					$('#message').addClass(data.class_name);
				}
			})	
		});       

	</script>
</body>
</html>