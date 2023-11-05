var token = JSON.parse(localStorage.getItem('session'))
var url = "http://127.0.0.1:8000/api/"
var id = new URLSearchParams(window.location.search).get("id")

const erroPass = document.querySelector('#erro-pass')
const password = document.querySelector('#password')
const upload = document.querySelector('#upload')
const email = document.querySelector('#email')
const name = document.querySelector('#name')
const status = document.querySelector('#status')


window.addEventListener('load', () => {
    const config = {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token.access_token}`,
            'Content-Type': 'application/json'
        }
    }
    fetch(`${url}getUser?id=${id}`, config)
    .then(response => {
        if (!response.ok) {
        throw new Error(`Erro na solicitação: ${response.status}`)
        }
        return response.json() 
    })
    .then(res => {
        email.value = res.user.email
        name.value = res.user.name
        status.value = res.user.status
    })
    .catch(error => {
        console.error('Ocorreu um erro:', error)
    });
})

upload.addEventListener('submit', (event) => {
    event.preventDefault();

    const data = {
        id: id,
        name: name.value == '' ? null : name.value,
        email: email.value == '' ? null : email.value,
        status: status.value == '' ? mull : status.value,
        password: password.value == '' ? null : password.value
    }    
    
    const config = {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token.access_token}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }
    fetch(`${url}update`, config)
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