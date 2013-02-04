$(document).ready(function() {
    Shadowbox.init();
    $(".draggable").draggable();
});

function recarga(){
    window.location=window.location;
}

function guarda(URLControlador){
    contenido=$("#anverso").html();
    contenido1=$("#reverso").html();
    $.ajax({
        url: URLControlador+'ajax',
        type: "POST",
        cache: false,
        data: "anverso="+contenido+"&reverso="+contenido1+"&hs="+$("#hs").val()+'&vs='+$("#vs").val()+'&ms='+$("#ms").val(),
        success: function(data) {
            alert('La calibracion ha sido guardada.');
        }
    });
}

function exporta(URLControlador){
    guarda(URLControlador);
    window.location=URLControlador+'ajax/exportar/1';
}

function imprime(URLControlador){
    guarda(URLControlador);
    Shadowbox.open({
        content: URLControlador+'printpage',
        player: "iframe",
        title:  'Impresión de prueba',
        height: 430,
        width:  750
    });
}

function reset(){
    $.ajax({
        url: 'ajax',
        type: "POST",
        cache: false,
        data: "reset=1",
        success: function(data) {
            recarga();
        }
    });
}