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
        url: URLControlador+'/ajax',
        type: "POST",
        cache: false,
        data: { anverso:contenido, reverso:contenido1, hs:$("#hs").val(), vs:$("#vs").val(), ms:$("#ms").val() },
        success: function(data) {
            alert(URLControlador+'/ajax');
            /*alert('Definicion de matricula guardada.');*/
        },
        error:function (xhr, ajaxOptions, thrownError, request, error){
            alert('xrs.status = ' + xhr.status + '\n' + 
                'thrown error = ' + thrownError + '\n' +
                'xhr.statusText = '  + xhr.statusText + '\n' +
                'request = ' + request + '\n' +
                'error = ' + error);
        }  
    });
}

function reset(){
    $.ajax({
            url: URLControlador+'/ajax/reset',
            type: "POST",
            cache: false,
            data: "reset=1",
            success: function(data) {
                recarga();
            }
        });
}

function imprime(URLControlador){
    guarda(URLControlador);
    Shadowbox.open({
        content:    URLControlador+'/printpage',
        player:     "iframe",
        title:      'Imprimir',
        height:     430,
        width:      750
    });
}

function exportar(){
    guarda();
    window.location=URLControlador+'/exportar/1';
}