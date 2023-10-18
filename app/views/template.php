
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>SISTEMA NF2</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		
		<link rel="stylesheet" href="<?php echo URL_BASE ?>assets/js/datatables/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="<?php echo URL_BASE ?>assets/js/datatables/css/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ?>assets/js/datatables/css/style_dataTable.css">
		<link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/auxiliar.css"> 
		<link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/grade.css">
		<!-- <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/style.css">	 -->
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="<?php echo URL_BASE ?>lib/plugins/fontawesome-free/css/all.min.css">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="<?php echo URL_BASE ?>lib/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo URL_BASE ?>lib/dist/css/adminlte.min.css">
		
		<link rel="stylesheet" href="<?php echo URL_BASE ?>lib/assets/style.css">
				
		<script src="<?php echo URL_BASE ?>assets/js/jquery.min.js"></script>	
		<script>
			var base_url = "<?php echo URL_BASE ?>";
		</script>
	</head>
	
	<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" >
		<?php include("cabecalho.php") ?>

<section class="content-wrapper">
 	<?php
	$this->load($view, $viewData); ?>	
</div>	
		
</section>

	
	
		
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://kit.fontawesome.com/9480317a2f.js"></script>
		<script src="<?php echo URL_BASE ?>assets/js/datatables/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo URL_BASE ?>assets/js/datatables/js/dataTables.responsive.min.js"></script>
	
		<script src="<?php echo URL_BASE ?>assets/js/jquery.mask.js"></script>	
		<script src="<?php echo URL_BASE ?>assets/js/componentes/js_data_table.js"></script>
		<script src="<?php echo URL_BASE ?>assets/js/componentes/js_modal.js"></script>
		<script src="<?php echo URL_BASE ?>assets/js/componentes/js_mascara.js"></script>
		<script src="<?php echo URL_BASE ?>assets/js/js.js"></script>	
		<?php include 'rodape.php'?>
</body>
</html>