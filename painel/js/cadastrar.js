var token = JSON.parse(localStorage.getItem('session'))
var url = "http://127.0.0.1:8000/api/"
const erroPass = document.querySelector('#erro-pass')
const currentPassword = document.querySelector('#current-pass')
const password = document.querySelector('#password')
const register = document.querySelector('#register')

currentPassword.addEventListener('input', function () {
    let pass = password.value;
    let currentPass = currentPassword.value;

    if (pass === currentPass || currentPass === '') {
        erroPass.textContent = ''
    } else {
        erroPass.textContent = 'As senhas não coincidem';
    }
})

register.addEventListener('submit', (event) => {
    event.preventDefault();
    const email = document.querySelector('#email')
    const password = document.querySelector('#password')
    const name = document.querySelector('#name')

    const data = {
        name: name.value,
        email: email.value,
        password: password.value
    }    
    
    const config = {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token.access_token}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }
    fetch(`${url}register`, config)
    .then(response => {
        if (!response.ok) {
        throw new Error(`Erro na solicitação: ${response.status}`)
        }
        return response.json() 
    })
    .then(res => {
        alert(res.response)
        location.reload()
    })
    .catch(error => {
        alert('Erro ao cadastrar')
    })
})