const toggler = document.querySelector(".btn");
toggler.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

function checkAge() {
    const birthdate = document.getElementById("birthdate").value;
    const responsavelSection = document.getElementById("responsavel-section");
    const termoAutorizacao = document.getElementById("termo-autorizacao");
    const documentosResponsavel = document.getElementById("documentos-responsavel");

    if (birthdate) {
        const birthDate = new Date(birthdate);
        const today = new Date();
        const age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        if (age < 18) {
            responsavelSection.style.display = "block";
            termoAutorizacao.style.display = "block";
            documentosResponsavel.style.display = "block";
        } else {
            responsavelSection.style.display = "none";
            termoAutorizacao.style.display = "none";
            documentosResponsavel.style.display = "none";
        }
    }
}

// redirecionar o usuário para a página de cadastro
function redirectToRegister() {
    window.location.href = "cadastrar.html";
}


// validaçao cadastro

function validateForm(event) {
    event.preventDefault(); // Evitar o envio do formulário até validar

    // Pegando os valores dos campos
    const name = document.getElementById('name').value.trim();
    const birthdate = document.getElementById('birthdate').value;
    const phone = document.getElementById('phone').value.trim();
    const email = document.getElementById('email').value.trim();
    const cpf = document.getElementById('cpf').value.trim();
    const ra = document.getElementById('ra').value.trim();

    // Verifica se o nome está vazio
    if (name === '') {
        alert("O campo Nome é obrigatório.");
        return;
    }

    // Verifica a idade mínima de 18 anos
    const today = new Date();
    const birth = new Date(birthdate);
    const age = today.getFullYear() - birth.getFullYear();
    if (age < 18 || (age === 18 && today < new Date(birth.setFullYear(today.getFullYear())))) {
        alert("É necessário ter pelo menos 18 anos.");
        return;
    }

    // Validação de telefone (somente números e 11 dígitos)
    if (!/^\d{11}$/.test(phone)) {
        alert("O número de telefone deve conter 11 dígitos (apenas números).");
        return;
    }

    // Validação de CPF (somente números e 11 dígitos)
    if (!/^\d{11}$/.test(cpf)) {
        alert("O CPF deve conter 11 dígitos (apenas números).");
        return;
    }

    // Validação de RA (não vazio)
    if (ra === '') {
        alert("O campo RA é obrigatório.");
        return;
    }

    // Se tudo estiver OK, envia o formulário
    document.getElementById('registerForm').submit();
}

// Adicionar evento no botão de envio
document.getElementById('registerForm').addEventListener('submit', validateForm)




// login js

function onChangeEmail() {
    toggleButtonsDisable();
    toggleEmailErrors();
}

function onChangePassword() {
    toggleButtonsDisable();
    togglePasswordErrors();
} 

function toggleEmailErrors() {
    const email = document.getElementById("email").value;
    if (!email) {
        document.getElementById("email-required-error").style.display = "block";
    } else {
        document.getElementById("email-required-error").style.display = "none";
    }
    
    if (validateEmail(email)) {
        document.getElementById("email-invalid-error").style.display = "none";
    } else {
        document.getElementById("email-invalid-error").style.display = "block";
    }
}

function togglePasswordErrors() {
    const password = document.getElementById("password").value;
    if (!password) {
       document.getElementById("password-required-error").style.display = "block";
    } else {
       document.getElementById("password-required-error").style.display = "none";
    }
}

function toggleButtonsDisable() {
    const emailValid = isEmailValid();
    document.getElementById("recover-password-button").disabled = !emailValid;

    const passwordValid = isPasswordValid();
    document.getElementById("login-button").disabled = !emailValid || !passwordValid;
}

function isEmailValid() {
    const email = document.getElementById("email").value;
    if (!email) {
        return false;
    }
    return validateEmail(email);
}

function isPasswordValid() {
    const password = document.getElementById("password").value;
    if (!password) {
        return false;
    }
    return true;
}

function validateEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}


// Mostrar/ocultar senha
document.getElementById('showPassword').addEventListener('change', function () {
    const passwordField = document.getElementById('password');
    passwordField.type = this.checked ? 'text' : 'password';
});

// Redirecionamento ao clicar em "Entrar"
document.getElementById('loginButton').addEventListener('click', function () {
    // Certifique-se de que index.html esteja no mesmo diretório
    window.location.href = 'index.html';
});

