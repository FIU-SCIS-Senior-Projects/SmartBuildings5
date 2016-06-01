<!DOCTYPE HTML>
<html>
	<head>
		<title>Disaster Helper</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--add ref to main.css-->
                <?php echo $this->Html->css('myStyle'); ?>
		<!--link rel="stylesheet" href="assets/css/main.css" /-->
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<!--header id="header">
					</header-->

				<!-- Main -->
					<section id="main">
                                            <?php echo $this->fetch('content'); ?>						
					</section>

				<!-- Footer -->

			</div>

		<!-- Scripts -->

	</body>
</html>