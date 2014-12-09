window.addEventListener("load", function() {
    var borrar = document.getElementsByClassName("borrar");
    for (var i = 0; i < borrar.length; i++) {
        if(borrar[i]){
        borrar[i].addEventListener("click", confirmar);
    }
    }
    var editar = document.getElementsByClassName("editar");
    for (var i = 0; i < editar.length; i++) {
        editar[i].addEventListener("click", modificar);
    }

    function confirmar(e) {
        var idcasa = this.getAttribute("data-idcasa");
        var respuesta = confirm("¿Seguro que quiere borrar?");
        if (!respuesta) {
            e.preventDefault();
        }
    }

    function modificar(e) {
        e.preventDefault();
        var idcasa = this.getAttribute("data-idcasa");
        var f = document.getElementById("formulario");
        f.action="ver.php";
        var idf = document.getElementById("idformulario");
        idf.value = id;
        f.submit();
    }
});



