var url = "http://127.0.0.1:8000/api/"
var token = JSON.parse(localStorage.getItem('session'))
const title = document.querySelector('#title-admin')

window.addEventListener('load', () => {
    if(token){
        const dateToken = new Date(token.login_in)
        if((dateToken - new Date()) > token.expires_in.date){
            localStorage.removeItem('session')
            window.location.href = 'login.html'
        }  
        else if (((dateToken - new Date()) - token.expires_in) < 15){
            isSignedIn()
        }
        const config = {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token.access_token}`,
                'Content-Type': 'application/json'
            }
        }
        fetch(`${url}me`, config)
        .then(response => {
            if (!response.ok) {
                localStorage.removeItem('session')
                window.location.href = 'login.html' 
            }
            return response.json() 
        })
        .then(res => {
            title.innerHTML = `Bem vindo ${res.name.split(' ')[0]}`
        })
        .catch(error => {
        });
        
    }
    else window.location.href = 'login.html' 
})

function isSignedIn(){
    const config = {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token.access_token}`,
            'Content-Type': 'application/json'
        }
    }
    fetch(`${url}refresh`, config)
    .then(response => {
        if (!response.ok) {
        throw new Error(`Erro na solicitação: ${response.status}`)
        }
        return response.json() 
    })
    .then(res => {
        localStorage.setItem('session', JSON.stringify(res))
        console.log('Sessão renovada')
    })
    .catch(error => {
        console.log('Sessão expirando..')
    });   
}