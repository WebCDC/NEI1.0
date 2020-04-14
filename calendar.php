<?php include('navbar.php'); ?>

<?php startblock('head') ?>
	<meta name="description" content="Calendário de todos os eventos do NEI">
	<title>NEI - Calendário</title>
	
	<link rel="stylesheet" href="static/fullcalendar-3.9.0/fullcalendar.min.css">
<?php endblock() ?>

<?php startblock('custom_js') ?>
    <script src="static/fullcalendar-3.9.0/lib/moment.min.js"></script>
    <script src="static/fullcalendar-3.9.0/fullcalendar.js"></script>
    <script src="static/fullcalendar-3.9.0/gcal.js"></script>
    <script src='static/fullcalendar-3.9.0/locale/pt.js'></script>
    <script src='static/js/calendar.js'></script>
<?php endblock() ?>

<?php startblock('body') ?>
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div id='calendar'></div>
				</div>
			</div>
		</div>
	</section>	
<?php endblock() ?>
