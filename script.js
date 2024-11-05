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
// Início da validação CPF
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    // Elimina CPFs inválidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    // Valida 1º dígito
    let add = 0;
    for (let i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    let rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Valida 2º dígito
    add = 0;
    for (let i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}
// Adicionar evento de input ao campo CPF
document.getElementById('cpf').addEventListener('input', function() {
    const cpf = this.value;
    const campoCPF = this.parentNode;
    if (!validarCPF(cpf)) {
        campoCPF.classList.add('erro');
        if (!campoCPF.querySelector('.erro-mensagem')) {
            const mensagemErro = document.createElement('div');
            mensagemErro.className = 'erro-mensagem';
            mensagemErro.textContent = 'Cpf inválido!';
            campoCPF.appendChild(mensagemErro);
        }
    } else {
        campoCPF.classList.remove('erro');
        const mensagemErro = campoCPF.querySelector('.erro-mensagem');
        if (mensagemErro) {
            mensagemErro.remove();
        }
    }
});
// fim da validação cpf
// Função para limpar sessão
function limparSessao() {
    fetch('../php/limparSessao.php')
        .then(response => {
            if (response.ok) {
                console.log('Sessão limpa');
            } else {
                console.log('Erro ao limpar sessão');
            }
        });
}
// Evento para limpar sessão quando a página é carregada
window.addEventListener('load', limparSessao);
// Evento para limpar sessão quando a página é fechada ou o usuário navega para longe
window.addEventListener('beforeunload', limparSessao);
// fim Limpar dados da sessão ao recarregar a página
