<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Md Sazzad Hossain | Web Developer</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.0/milligram.css">
	<style>
		#main{
			padding: 60px 0;
		}
		#main form{
			background-color: #f8f8f8;
			padding: 25px;
			border-radius: 7px;
			box-shadow: 0px 0px 9px 2px #0000000f;
		}
	</style>
</head>
<body>
	<section id="main">
		<div class="container">
		  <div class="row">
		    <div class="column">
		    	<?php echo form_open(base_url('welcome/payment'), ['id' => 'validation', 'class' => 'validation']); ?>
		    	  <fieldset>
		    	    <label for="amount">Amount</label>
		    	    <input name="amount" type="text" id="amount" value="500">
		    	    <input class="button-primary float-right" type="submit" value="Pay Now">
		    	  </fieldset>
		    	<?php echo form_close(); ?>
		    </div>
		  </div>
		</div>
	</section>
</body>
</html>