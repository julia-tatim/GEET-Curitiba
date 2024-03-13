
var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");


btnSignin.addEventListener("click", function () {
   body.className = "sign-in-js"; 
});

btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js";
})

function validateLoginPassword(){
    var passwordLoginInput = document.getElementById('passwordLoginInput');
    var passwordLogin = passwordLoginInput.value;
    var re = /^(?=.*\d)(?=.*[@#$%^&+=!])(.{6,})$/;

    if(!re.test(passwordLogin)){
        passwordLoginInput.focus();
        alert("Senha incorreta.");
        location.reload;
        return false;
    } else{
        alert('Login realizado com sucesso! \nRedirecionando para página inicial.');
        window.location.href = '../src/index.html'; 
        return true;
    }
}

function validateCadastroPassword(){
    var passwordInput = document.getElementById('passwordCadastroInput');
    var passwordConfirmInput = document.getElementById('passwordCadastroInputConfirm')

    var password = passwordInput.value;
    var confirmPassword = passwordConfirmInput.value;

    var re = /^(?=.*\d)(?=.*[@#$%^&+=!])(.{6,})$/;

    if(!re.test(password)){
        passwordInput.focus();
        alert("Digite senha com no mínimo 1 digito, 1 caractere especial e 6 caracteres");
        location.reload;
        return false;
    } else if(password !== confirmPassword){
        passwordConfirmInput.focus();
        alert("As senhas não coincidem.");
        location.reload;
        return false;
    }else{
        alert("Cadastro realizado com sucesso! \nRedirecionando para página inicial.");
        window.location.href = '../src/index.html'; 
        return true;
    }
}
