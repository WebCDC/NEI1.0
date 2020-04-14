/**
 * Função usada para a navegação entre as tabs 
 * dos anos das atas.
 * 
 * @author Daniel Teixeira
 */

$( document ).ready(function() { 
    $('section > div > div > div > div > ul > li > a').click(function(){
        $('li').removeClass('active');
        $(this).parent().addClass('active');
    });
});