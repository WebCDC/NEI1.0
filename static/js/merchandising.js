/**
 * Função de validação de merchandising.
 * Esta função verifica todas opções introduzidas pelo utilizador
 * e confirma se é possível fazer a compra, por fim, faz display
 * do preço total a pagar por essa mesma encomenda.
 * 
 * @author Daniel Teixeira
 */
$( document ).ready(function() {
	$('#validate').hide();
	var compras = document.getElementById("compras").children;
	var total = document.getElementById("total");
	function calcularTotal() {
		var precototal = 0;
		for (var compra of compras) {
			precototal += compra.children[0].value*parseFloat(compra.children[0].dataset.price);
		}
		total.value = precototal;
	}
	for (var compra of compras) {
		$(compra.children[0]).on("change", calcularTotal);
	}
	$("#form").submit(function() {
		if (total.value <= 0) {
			$('#validate').show();
			return false;
		}
		$('#validate').hide();
		return true;
	});
});
