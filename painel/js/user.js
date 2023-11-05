var url = "http://127.0.0.1:8000/api/"
const logout = document.querySelector('#logout')

window.addEventListener('load', () => {
    const token = JSON.parse(localStorage.getItem('session'))
    const table = document.querySelector('#body-table')
    const config = {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token.access_token}`,
            'Content-Type': 'application/json'
        }
    }
    fetch(`${url}getUsers`, config)
    .then(response => {
        if (!response.ok) {
        throw new Error(`Erro na solicitação: ${response.status}`)
        }
        return response.json() 
    })
    .then(res => {
        let response = res[0].users;
        response.forEach(data => {
            table.innerHTML += userTbaleHtml(data)
        });
    })
    .catch(error => {   
    });   
})

function userTbaleHtml(users){
    let html = `<tr>
        <td>${users.name}</td>
        <td>${users.email}</td>
        <td>
            <div class="d-flex justify-content-center">
                <button onclick="getUser(${users.id})" type="button" class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>

                <a href="editar.html?id=${users.id}" class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2" title="Editar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                        <path fill="#141618" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg>
                </a>

                <a href="#" onclick="deleteUser(${users.id})" class="btn btn-danger d-flex justify-content-center align-items-center rounded-circle p-2 mx-2" title="Deletar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path fill="#FFF" d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                        <path fill="#FFF" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                </a>
            </div>
        </td>
    </tr>`

    return html
}

function getUser(id){
    const modalName = document.querySelector('#modal-name')
    const modalEmail = document.querySelector('#modal-email')
    const modalStatus = document.querySelector('#modal-status')
    const token = JSON.parse(localStorage.getItem('session'))
    
    if(token){ 
        const config = {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token.access_token}`,
                'Content-Type': 'application/json',
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
            modalEmail.innerHTML = res.user.email
            modalName.innerHTML = res.user.name
            modalStatus.innerHTML = res.user.status
        })
        .catch(error => {
            console.log(`ERRO: ${error}`)
        });   
    } else alert('Sessão finzalida!')
}

function deleteUser(id){
    const token = JSON.parse(localStorage.getItem('session'))
    console.log(id)
    if(token){
        const data = {
            id: id
        }  
        const config = {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token.access_token}`,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        }
        fetch(`${url}delete`, config)
        .then(response => {
            if (!response.ok) {
            throw new Error(`Erro na solicitação: ${response.status}`)
            }
            return response.json() 
        })
        .then(res => {
            alert('Usuário deletado!')
            location.reload()
        })
        .catch(error => {
            console.log(`ERRO: ${error}`)
        });   
    } else alert('Sessão finzalida!')
}



logout.addEventListener('click', () => {
    const token = JSON.parse(localStorage.getItem('session'))
    
    if(token){
        const config = {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token.access_token}`,
                'Content-Type': 'application/json',
            }
        }
        fetch(`${url}logout`, config)
        .then(response => {
            if (!response.ok) {
            throw new Error(`Erro na solicitação: ${response.status}`)
            }
            return response.json() 
        })
        .then(res => {
            alert('Sessão encerrada!')
            localStorage.removeItem('session')
            window.location.href = 'login.html'
        })
        .catch(error => {
            alert('Erro ao encerrar a sessão')
        });   
    } else alert('Sessão encerrada!')
})