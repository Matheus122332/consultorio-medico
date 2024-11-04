// inicio rastro mouse
document.addEventListener('mousemove', function(e) {
    let particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.left = e.pageX + 'px';
    particle.style.top = e.pageY + 'px';
    document.body.appendChild(particle);
    setTimeout(function() {
        particle.remove();
    }, 500);
});
// fim rastro mouse
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
document.getElementById('cep').addEventListener('input', function() {
    let cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    console.log("CEP digitado: " + cep);

    if (cep.length === 8) { // Verifica se o CEP tem 8 dígitos
        let validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)) {
            console.log("CEP válido, iniciando fetch...");
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => {
                    console.log("Resposta recebida da API");
                    return response.json();
                })
                .then(data => {
                    if (!("erro" in data)) {
                        document.getElementById('cidade').value = data.localidade;
                        console.log("Cidade preenchida: " + data.localidade);
                    } else {
                        alert("CEP não encontrado.");
                        console.log("CEP não encontrado");
                        document.getElementById('cidade').value = ""; // Limpa o campo em caso de erro
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                    alert("Erro ao buscar o CEP.");
                    document.getElementById('cidade').value = ""; // Limpa o campo em caso de erro
                });
        } else {
            alert("Formato de CEP inválido.");
            console.log("Formato de CEP inválido");
        }
    }
});
// Fim cep