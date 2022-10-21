$(function() {
    $('nav.mobile').click(function() {
        var listaMenu = $('nav.mobile ul');
        if (listaMenu.is(':hidden') == true) {
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-bars');
            icone.addClass('fa-times');
            listaMenu.fadeIn();
        } else {
            listaMenu.fadeOut();
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-times');
            icone.addClass('fa-bars');
        }

    });

    if ($('target').length > 0) {
        //Faz a rolagem automática em sites one page
        var elemento = '#' + $('target').attr('target');
        var divScroll = $(elemento).offset().top;
        $('html,body').animate({ 'scrollTop': divScroll }, 2000);

    }
    // Carregar página ou conteudo dinamicamente
    carregarDinamico();

    function carregarDinamico() {
        $('[realtime]').click(function() {
            var pagina = $(this).attr('realtime');
            $('.container-principal').hide();
            $('.container-principal').load(include_path + 'pages/' + pagina + '.php');
            //Iniciar função de pois de determinado tempo
            setTimeout(function() {
                initialize();
            }, 1000);

            $('.container-principal').fadeIn(1000);
            window.history.pushState('', '', pagina);
            return false;
        })

    }
})