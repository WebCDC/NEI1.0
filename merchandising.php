<?php include('navbar.php'); ?>

<?php startblock('head') ?>
	<meta name="description" content="Lista e encomenda de merchandising do NEI">
	<title>NEI - Merchandising</title>
<?php endblock() ?>

<?php startblock('custom_js') ?>
    <script src="static/js/merchandising.js"></script>
<?php endblock() ?>

<?php startblock('body') ?>
	<!--Cartaz-->
    <section id="merchandising">
        <div class="container">
            <img class="img-fluid" src="static/img/Merch.png" />
        </div>
        <div class="container" style="padding-top: 30px;">
            <h2 class="section-heading text-uppercase">Encomendar:</h2>
            <!--Envio do email com a encomenda para o NEI-->
            <form action="https://formspree.io/nei@aauav.pt" method="POST" id="form">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" class="form-control" id="name" placeholder="Nome" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="nmec">NMEC:</label>
                    <input type="number" class="form-control" id="nmec" placeholder="Nº Mecanografico" name="nmec"
                        required>
                </div>
                <div class="form-group" id="compras">
                    <label for="caneta">Canetas: <input type="number" class="form-control" data-price="0.50" id="caneta"
                            name="caneta" value="0"></label>
                    <label for="emblema">Emblemas: <input type="number" class="form-control" id="emblema" data-price="2.50"
                            name="emblema" value="0"></label>
                    <label for="porta_moedas">Porta Moedas: <input type="number" class="form-control" id="porta_moedas"
                            data-price="1.00" name="porta_moedas" value="0"></label>
                    <label for="bloco_notas">Bloco de Notas: <input type="number" class="form-control" id="bloco_notas"
                            data-price="3.00" name="bloco_notas" value="0"></label>
                    <label for="isqueiro">Isqueiros: <input type="number" class="form-control" id="isqueiro" data-price="0.50"
                            name="isqueiro" value="0"></label>
                    <label for="fitas">Fitas: <input type="number" class="form-control" id="fitas" data-price="1.00"
                            name="fitas" value="0"></label>
                    <label for="pins">Pins: <input type="number" class="form-control" id="pins" data-price="1.00" name="pins"
                            value="0"></label>
                </div>
                <div class="alert alert-danger" role="alert" id=validate>
                    Escolha um ou mais produtos! <i class="fas fa-angry"></i>
                </div>
                <div class="form-group">
                    <label for="total">Total: <input type="number" class="form-control" id="total" name="total" value="0"
                            disabled></label>
                </div>
                <button type="submit" class="btn btn-primary submit-button" id="email-submit-btn" value="Send">Concluir</button>
            </form>
        </div>
    </section>
<?php endblock() ?>
