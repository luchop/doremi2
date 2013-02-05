<script>
$(document).ready(function(){
    $(":input:first").focus();
    $("#Formulario").validate({
        highlight: function(label) {;},
        errorContainer: "#errorContainer",
        errorLabelContainer: "#errorContainer",
        errorElement: "li"
    });
})
</script>