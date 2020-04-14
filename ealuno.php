<?php include('navbar.php'); ?>

<?php startblock('head') ?>
<meta name="description" content="Acesso à base de dados de apontamentos do NEI">
<title>NEI - Apontamentos</title>
<?php endblock() ?>

<?php startblock('custom_js') ?>
<script src="static/js/apontamentos.js"></script>
<?php endblock() ?>

<?php if( !(isset($_SESSION['valid'])) OR !($_SESSION['valid']) ) : ?>
	<?php
		$_SESSION['after_login'] = $_SERVER['PHP_SELF'];
		header("Location: login.php");
		exit();
	?>

<?php else : ?>
	<?php startblock('body') ?>
		<!-- Apontamentos -->
		<section id="apontamentos" class="container-fluid apt">
			<!-- Anos-->
			<div id="anos" class="row">

				<button class="btn apont-button col-lg-2 offset-lg-2 col-md-4 offset-md-1 col-sm-4 offset-sm-1 col-10 offset-1"
				data-type="ano" data-value="1">
					<h4 data-type="ano" data-value="1"> 1º Ano</h4>
				</button>

				<button class="btn apont-button col-lg-2 offset-lg-1 col-md-4 offset-md-2 col-sm-4 offset-sm-2 col-10 offset-1"
				data-type="ano"  data-value="2">
					<h4 data-type="ano"  data-value="2">2º Ano</h4>
				</button>

				<button class="btn apont-button col-lg-2 offset-lg-1 col-md-4 offset-md-1 col-sm-4 offset-sm-1 col-10 offset-1"
				data-type="ano"  data-value="3">
					<h4 data-type="ano"  data-value="3">3º Ano</h4>
				</button>

				<button class="btn apont-button col-lg-2 offset-lg-3 col-md-4 offset-md-2 col-sm-4 offset-sm-2 col-10 offset-1"
				data-type="ano" data-value="4">
					<h4 data-type="ano"  data-value="4">4º Ano</h4>
				</button>

				<button class="btn apont-button col-lg-2 offset-lg-2 col-md-4 offset-md-4 col-sm-4 offset-sm-4 col-10 offset-1"
				data-type="ano" data-value="5">
					<h4 data-type="ano" data-value="5">5º Ano</h4>
				</button>
			</div>

			<!-- Semestres -->
			<div id="semestres" class="row hide">
				<h2 class="apont-header col-12 u-break-word" id="semestres_title" class="col-lg-12"></h2>

				<button class="btn apont-button col-lg-2 col-md-4 col-sm-10  col-10 offset-lg-2 offset-md-2 offset-sm-1 offset-1"
				data-type="semestre" data-value="1">
					<h4 data-type="semestre" data-value="1">1º Semestre</h4>
				</button>
				
				<button class="btn apont-button col-lg-2 col-md-4 col-sm-10 col-10 offset-lg-1 offset-md-1 offset-sm-1 offset-1"
				data-type="semestre" data-value="2">
					<h4 data-type="semestre" data-value="2">2º Semestre</h4>
				</button>
				
				<button class="btn apont-button col-lg-2 col-md-5 col-sm-10 col-10 offset-lg-1 offset-md-4 offset-sm-1 offset-1"
				data-type="semestreback">
					<i class="fa fa-arrow-left" style="font-size:45px;" aria-hidden="true" data-type="semestreback"></i>
				</button>
			</div>


			<!-- Container que receberá as disciplinas e os documentos dinâmicamente-->
			<div class="container col-lg-12 hide" id="displayer">
			</div>

			<!-- Disciplinas back button-->
			<div id="disciplinas" class="hide">
				<button class="btn apont-button col-lg-2 col-md-5 col-sm-10 col-10 offset-lg-5 offset-md-4 offset-sm-1 offset-1" data-type="disciplinasback">
					<i class="fa fa-arrow-left" style="font-size:45px;" aria-hidden="true" data-type="disciplinasback"></i>
				</button>
			</div>
			
			<!-- Recursos da Disciplina -->
			<div id="recursos" class="hide">
				<table class="table">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Autor</th>
						</tr>
					</thead>
					<tbody class="">
						<tr>
							<td>
								<a href="" target="_blank" style="color:green" class=""></a>
							</td>
							<td>
							</td>
						</tr>
					</tbody>
				</table>

				<button class="btn apont-button col-lg-2 col-md-4 col-sm-10 col-10 offset-lg-5 offset-md-4 offset-sm-1 offset-1" data-type="disciplinaback">
					<i class="fa fa-arrow-left" style="font-size:45px;" aria-hidden="true" data-type="disciplinaback"></i>
				</button>
			</div>
		</section>
    <div class="portfolio-modal modal fade" id="memeITW" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <div class="container">
                <img src="./static/img/meme/memeITW.jpg">
            </div>
          </div>
        </div>
      </div>
	<?php endblock() ?>
<?php endif; ?>

