<!DOCTYPE HTML>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link href="stylesheet/bootstrap.min.css" rel="stylesheet">
	<link href="stylesheet/my.css" rel="stylesheet">
</head>

<html>
<body>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-7">
				<div class="converter-wrap">

					<h1>Конвертер валют:</h1>

					<?php 
						$course_curr = 0;
						$curr_default = 'USD';
					?>

					<form id="form" method="post" class="form-inline">

						<div class="form-group">
							<label class="control-label" for="count_ua">Кол-во грн:</label>
							<input id="count_ua" class="form-control" type="number" name="count_ua" required  placeholder="Кол-во грн" value="1" value="1.00" min="0" max="999999" step="any">
						</div>

						<div class="form-group">

							<label class="control-label" for="name_val">Валюта:</label>
							<select id="name_val" class="form-control" required size = "1" name = "name_val">
								<option disabled>Валюта</option>
								<option selected value = "USD">USD</option>
								<option value = "EUR">EUR</option>
								<option value = "RUR">RUR</option>
							</select>
						</div>						

						<button type="submit" value="send" class="btn btn-success">Рассчитать</button>
						<br><br>

						<div class="form-group course-group">			 
							<label class="control-label" for="course-curr">Курс:</label>
							<input id="course-curr" class="form-control" type="number" name="val_ua" disabled required placeholder="Курс">
						</div>

					</form>

					<br>
					<div id="result"></div>
					<br>

				</div>
			</div>
		</div>
	</div>

	<script>
		$('#course-curr').val('<?php echo $course_curr; ?>');

		$(function() {
			$('#name_val').on('change', function() {
				var name_val = $('#name_val').val();

				$('#course-curr').val(0);
				$('#result').html(''); 
				$('.course-group').css('display','none');

			})
		});

		$("#form").submit(function(e) {
			var name_val = $("#name_val").val();
			var course_curr = $("#course-curr").val();
			var count_ua = $("#count_ua").val();

			$('.course-group').css('display','block');

			$.ajax({
				type: "POST",
				url: "return_course.php",
				data:{name_val: name_val,
					count_ua: count_ua},
					dataType: 'json',
					error: function(data) {
						$('#result').html('<p class="text-error" style="color:#f5345f">Ошибка чтения!</p>'); 
					},
					success: function(data){
						$('#course-curr').val(data.kurs);
						$('#result').html('<b>Результат: </b>' + data.result); 
					}
				});

			e.preventDefault();
		});

	</script>

	<script src="js/bootstrap.min.js"></script>

</body>
</html>


