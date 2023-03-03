function validateForm() {
    var senha = document.getElementById("senha").value;
    var confirmarSenha = document.getElementById("confirmarSenha").value;

    if (senha != confirmarSenha) {
        alert("As senhas não correspondem!");
        return false;
    }
    }