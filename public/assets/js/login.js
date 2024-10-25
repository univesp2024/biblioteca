function formataCPF(cpf) {
    cpf = cpf.replace(/\D/g, "");
    const regexCpf = /(\d{3})(\d{3})(\d{3})(\d{2})/;
    return cpf.replace(regexCpf, "$1.$2.$3-$4");
}

function validateCPFLength(cpf) {
    const cpfLength = cpf.replace(/\D/g, "").length;
    return cpfLength === 11;
}

function validatePassword(password) {
    return password.trim() !== "";
}

function handleFormSubmission(event) {
    removeInvalidClasses();
    const cpf = document.getElementById("cpf").value;
    const password = document.getElementById("senha").value;
    
    const isValidCPF = validateCPFLength(cpf);
    const isValidPassword = validatePassword(password);
    
    if (!isValidCPF) {
        event.preventDefault();
        document.getElementById("cpf").classList.add("invalid");
    } 
    if (!isValidPassword) {
        event.preventDefault();
        document.getElementById("senha").classList.add("invalid");
    } else {
        lembrar();
    }
}

function removeInvalidClasses() {
    const form = document.querySelector("form");
    const invalidFields = form.querySelectorAll(".invalid");

    for (const field of invalidFields) {
        field.classList.remove("invalid");
    }
}

function lembrar() {
    const lembrarCheckbox = document.getElementById("lembrar");
    const campoCpf = document.getElementById("cpf");
    if (lembrarCheckbox.checked && campoCpf.value !== "") {
        localStorage.cpf = campoCpf.value;
        localStorage.checkbox = lembrarCheckbox.checked;
    } else {
        localStorage.cpf = "";
        localStorage.checkbox = "";
    }
}

const campoCpf = document.getElementById("cpf");
const campoSenha = document.getElementById("senha");

campoCpf.addEventListener("input", () => {
    campoCpf.value = formataCPF(campoCpf.value);
});

document.querySelector(".login_btn").addEventListener("click", handleFormSubmission);

const lembrarCheckbox = document.getElementById("lembrar");
if (localStorage.checkbox && localStorage.checkbox !== "") {
    lembrarCheckbox.checked = true;
    campoCpf.value = localStorage.cpf;
} else {
    lembrarCheckbox.checked = false;
    campoCpf.value = "";
}
