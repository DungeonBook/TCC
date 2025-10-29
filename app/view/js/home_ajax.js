function carregarUsuarios(BASEURL) {

    var xhttp = new XMLHttpRequest();

    var url = BASEURL + "/controller/UsuarioController.php?action=listJson";
    xhttp.open('GET', url);

    xhttp.onload = function() {
        var listaUsuarios = document.getElementById("listaUsuarios");
        listaUsuarios.innerHTML = "";
        
        var json = xhttp.responseText;
        var usuarios = JSON.parse(json);

        for(var i=0; i<usuarios.length; i++) {
            var item = document.createElement("li");
            item.innerHTML = usuarios[i].nome;

            listaUsuarios.appendChild(item);
        }

    }

    xhttp.send();
}