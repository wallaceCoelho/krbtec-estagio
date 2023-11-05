var url = "http://127.0.0.1:8000/api/"
const login = document.querySelector('#login')
var token = JSON.parse(localStorage.getItem('session'))

window.addEventListener('load', () => {
    if(token)
    {
        let urlCurrent = window.location.href;
        if(urlCurrent.split('/').reverse()[0] = 'login.html') window.location.href = 'painel.html'
    }
})

login.addEventListener('submit', (event) => {
    event.preventDefault();
    const email = document.querySelector('#email')
    const password = document.querySelector('#password')
    const data = {
        email: email.value,
        password: password.value
    }    
    
    const config = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    }
    fetch(`${url}login`, config)
    .then(response => {
        if (!response.ok) {
        throw new Error(`Erro na solicitação: ${response.status}`)
        }
        return response.json() 
    })
    .then(res => {
        localStorage.setItem('session', JSON.stringify(res))
        window.location.href = 'painel.html'
    })
    .catch(error => {
        alert('Usuário e/ou senha inválidos')
    })   
})