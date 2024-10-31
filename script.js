// inicio verificação email
document.getElementById('criarConta').addEventListener('submit', function(event) {
    let email = document.getElementById('email').value;
    let regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!regex.test(email)) {
        alert("Formato de email inválido. Por favor, insira um email válido.");
        event.preventDefault();
    }
});
// fim vericação email
// inicio telefone com ddd
document.addEventListener('DOMContentLoaded', function() {
    const telefoneField = document.getElementById('fone');
    telefoneField.addEventListener('input', function(event) {
        const value = event.target.value.replace(/\D/g, '');
        const formattedValue = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        event.target.value = formattedValue.substring(0, 15);
    });
});
// Fim telefone com ddd
// Inicio cep
document.getElementById('cep').addEventListener('input', function(event) {
    const pattern = /^\d{5}-\d{3}$/;
    const cep = event.target.value;
    if (!pattern.test(cep)) {
        event.target.setCustomValidity('Formato esperado: 12345-678');
    } else {
        event.target.setCustomValidity('');
    }
});
// Fim cep