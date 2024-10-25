function formataCPF(cpf) {
    cpf = cpf.replace(/\D/g, "");
    const regexCpf = /(\d{3})(\d{3})(\d{3})(\d{2})/;
    return cpf.replace(regexCpf, "$1.$2.$3-$4");
}

function formatPhone(phoneNumber) {
    const cleanedNumber = phoneNumber.replace(/\D/g, "");
    const formattedNumber = cleanedNumber.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
    return formattedNumber;
  }
  
  const campoTel = document.getElementById("telefone");
  
  campoTel.addEventListener("input", function() {
    const formattedValue = formatPhone(this.value);
    this.value = formattedValue;
  });
  

const campoCpf = document.getElementById("cpf");

campoCpf.addEventListener('input', () => {
    campoCpf.value = formataCPF(campoCpf.value);
});

(() => {
    'use strict'
  
    const forms = document.querySelectorAll('.needs-validation')
  
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()