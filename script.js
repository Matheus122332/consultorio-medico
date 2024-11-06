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
// Validação do RG
document.addEventListener('DOMContentLoaded', function() {
    // Selecionar o formulário e os campos
    const form = document.getElementById('criarConta');
    const rgInput = document.getElementById('rg');
    const rgError = document.getElementById('rgError');

    // Função para validar RG
    function validarRG() {
        const rg = rgInput.value.trim();
        const rgPattern = /^[0-9]{2}\.[0-9]{3}\.[0-9]{3}-[0-9X]$/; // Formato esperado: 12.345.678-9 ou 12.345.678-X

        if (!rgPattern.test(rg)) {
            rgError.textContent = 'Formato inválido. Ex: 12.345.678-9.';
            rgInput.classList.add('erro');
            return false;
        } else {
            rgError.textContent = '';
            rgInput.classList.remove('erro');
            return true;
        }
    }

    // Adicionar evento ao campo de RG
    rgInput.addEventListener('input', validarRG);

    // Adicionar evento ao envio do formulário
    form.addEventListener('submit', function(event) {
        if (!validarRG()) {
            event.preventDefault(); // Impedir o envio do formulário se o RG for inválido
        }
    });
});
// fim Validação do RG
// Validação do CPF
document.getElementById('cpf').addEventListener('input', function() {
    const cpf = this.value;
    const cpfError = document.getElementById('cpfError');
    const campoCPF = this.parentNode;
    if (!validarCPF(cpf)) {
        campoCPF.classList.add('erro');
        cpfError.style.display = 'block';
        cpfError.innerHTML = 'Cpf inválido!';
        this.setCustomValidity("Cpf inválido!");
    } else {
        campoCPF.classList.remove('erro');
        cpfError.style.display = 'none';
        this.setCustomValidity("");
    }
});
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    if (cpf.length != 11 || /^(.)\1*$/.test(cpf)) return false;
    let soma = 0, resto;
    for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i-1, i)) * (11 - i);
    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) resto = 0;
    if (resto != parseInt(cpf.substring(9, 10))) return false;
    soma = 0;
    for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i-1, i)) * (12 - i);
    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) resto = 0;
    if (resto != parseInt(cpf.substring(10, 11))) return false;
    return true;
}
// Validação da Senha
// Adicionar evento de input ao campo Confirmar Senha
document.getElementById('criarConta').addEventListener('submit', function(event) {
    const senha = document.getElementById('senha').value;
    const confirmarSenha = document.getElementById('confirmar_senha').value;
    const senhaError = document.getElementById('senhaError');
    let erro = false;
    // Verificar se as senhas coincidem
    if (senha !== confirmarSenha) {
        senhaError.style.display = 'block';
        senhaError.innerHTML = 'As senhas não coincidem.';
        erro = true;
    } else {
        senhaError.style.display = 'none';
    }
    // Verificar complexidade da senha
    if (senha.length < 8 || !/[A-Z]/.test(senha) || !/\d/.test(senha) || !/[!@#$%^&*]/.test(senha)) {
        senhaError.style.display = 'block';
        senhaError.innerHTML = 'Senha fraca. Exemplo: @Teste12';
        erro = true;
    }
    if (erro) {
        event.preventDefault(); // Impedir o envio do formulário se houver erros
    }
});
// Validar senhas em tempo real
document.getElementById('confirmar_senha').addEventListener('input', function() {
    const senha = document.getElementById('senha').value;
    const confirmarSenha = this.value;
    const senhaError = document.getElementById('senhaError');

    if (senha !== confirmarSenha) {
        senhaError.style.display = 'block';
        senhaError.innerHTML = 'As senhas não coincidem.';
        this.setCustomValidity("As senhas não coincidem.");
    } else {
        senhaError.style.display = 'none';
        this.setCustomValidity("");
    }
});
document.getElementById('senha').addEventListener('input', function() {
    const confirmarSenha = document.getElementById('confirmar_senha').value;
    const senhaError = document.getElementById('senhaError');

    if (this.value !== confirmarSenha && confirmarSenha !== "") {
        senhaError.style.display = 'block';
        senhaError.innerHTML = 'As senhas não coincidem.';
        document.getElementById('confirmar_senha').setCustomValidity("As senhas não coincidem.");
    } else {
        senhaError.style.display = 'none';
        document.getElementById('confirmar_senha').setCustomValidity("");
    }
});
// fim verificação senha
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
