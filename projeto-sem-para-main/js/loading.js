var campo = $('#CPF');

    campo.on("input",function(){
        var conteudo = campo.val();
        var Digitos = conteudo.split(/\d/).length - 1;

        if (Digitos === 9 || Digitos === 14) {
            var loading = document.getElementById("carregando");
            loading.classList.remove("d-none");
            console.log(loading);
            setTimeout(function() {
                loading.classList.add("d-none");
            }, 4000);
        }
    });
