$(function(){
    $('form').submit(function(){
        return false;
    })

    $('form').on('submit','form',function(){
        alert('Funfou!');
        return false;
    })
})