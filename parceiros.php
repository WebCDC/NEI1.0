<?php include('navbar.php'); ?>

<?php startblock('head') ?>
	<meta name="description" content="Lista de parceiros do NEI">
	<title>NEI - Parceiros</title>
<?php endblock() ?>

<?php startblock('body') ?>
	<!--Lista de parceiros -->
  <section id="portfolio">
    <div class="container">
      <div class="row">

        <div class="col-md-6 col-sm-6 portfolio-item">
          <a class="portfolio-link" data-toggle="modal" href="#portfolioModal" style="text-align: center">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fa fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="static/img/patrocinadores/Olisipo.png" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Olisipo</h4>
            <br>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="https://www.olisipo.pt/" target="_blank">
                  <i class="fas fa-external-link-alt"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.facebook.com/OlisipoTI/" target="_blank">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-6 col-sm-6 portfolio-item">
          <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2" style="text-align: center">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fa fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="static/img/patrocinadores/Lavandaria.png" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Lavandaria Portuguesa</h4>
            <br>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="https://www.facebook.com/alavandariaportuguesa.pt/"target="_blank">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <!-- Modal 1 -->
  <div class="portfolio-modal modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-4 mx-auto">
              <img class="img-fluid" src="static/img/patrocinadores/Olisipo.png" alt="">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <p class="item-intro text-muted">Parceiro</p>
                <p>Aliou-se ao NEI em agosto de 2018, sendo o nosso patrocinador mais recente.
                  Tem ajudado o núcleo na área desportiva patrocinando os novos equipamentos para a disputa na Taça UA.
                  A Olisipo é uma empresa especializada no recrutamento, formação e gestão de carreira de
                  profissionais na área das Tecnologias de Informação.
                  A sua sede encontra-se em Lisboa, no entanto apresenta delegações nas cidades do Porto e Aveiro.
                </p>
                <div class="row">
                  <div class="col-lg-6 mx-auto">
                    <img class="img-fluid" src="static/img/equipamento/equipamento.png">

                  </div>
                  <div class="col-lg-6 mx-auto">
                    <img class="img-fluid" src="static/img/equipamento/equipamento2.png">
                  </div>
                </div>
                <ul class="list-inline mx-auto">
                    <li class="list-inline-item">
                      <a href="https://www.olisipo.pt/" target="_blank" style="text-decoration: none">
                        <h5>Website</h4>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="https://www.facebook.com/OlisipoTI/" target="_blank">
                        <i class="fab fa-3x fa-facebook"></i>
                      </a>
                    </li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 2 -->
  <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-4 mx-auto">
              <img class="img-fluid" src="static/img/patrocinadores/Lavandaria.png" alt="">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <p class="item-intro text-muted">Parceiro</p>
                <p>A Lavandaria Portuguesa encontra-se aliada ao NEI desde março de 2018,
                  ajundando o núcleo na área desportiva com lavagens de equipamentos dos
                  ateltas que representam o curso.
                  A Lavandaria Portuguesa presta serviços de Limpeza, Secagem e Engomadoria
                  de todo o tipo de roupas, num modelo Self Service. Pretende melhorar a
                  qualidade de vida dos habitantes de Aveiro, através de um serviço, que
                  permite com conforto e bem estar lavar, secar e engomar as suas roupas.
                  No mundo universitário torna-se num conforto para aqueles que acabam por
                  não ter tempo para estes cuidados de roupa.
                </p>
                <div class="row">
                  <div class="col-lg-6 mx-auto">
                    <img class="img-fluid" src="static/img/equipamento/equipamento.png">

                  </div>
                  <div class="col-lg-6 mx-auto">
                    <img class="img-fluid" src="static/img/equipamento/equipamento2.png">
                  </div>
                </div>
                <ul class="list-inline mx-auto">
                    <li class="list-inline-item">
                      <a href="https://www.facebook.com/alavandariaportuguesa.pt/" target="_blank">
                        <i class="fab fa-3x fa-facebook"></i>
                      </a>
                    </li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endblock() ?>
