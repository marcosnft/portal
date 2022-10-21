$(function() {
    var atual = -1;
    var maximo = $('.box-especialidade').length - 1;
    var timer;
    var animacaoDelay = 3;

    executarAnimacao();

    function executarAnimacao() {
        timer = setInterval(logicaAnimacao, animacaoDelay * 1000);
        $('.box-especialidade').hide();

        function logicaAnimacao() {
            atual++;
            if (atual > maximo) {
                clearInterval(timer);
                return false;
            }
            $('.box-especialidade').eq(atual).fadeIn();
        }
    }
})