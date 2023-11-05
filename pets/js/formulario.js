var url = "http://127.0.0.1:8000/api/"
var id = new URLSearchParams(window.location.search).get("id")

window.addEventListener('load', () => {
    const form = document.querySelector('#form-pet')
    const config = {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        }
    }
    fetch(`${url}getPet?id=${id}`, config)
    .then(response => {
        if (!response.ok) {
        throw new Error(`Erro na solicitação: ${response.status}`)
        }
        return response.json() 
    })
    .then(res => {
        form.innerHTML = formPetHtml(res.pet)
    })
    .catch(error => {
        console.error('Ocorreu um erro:', error)
    });
})

function formPetHtml(pet)
{
    const html = `<div class="form-group py-2 col-12">
            <label for="solicitante" class="text-capitalize text-light">Seu nome:</label>
            <input type="text" class="form-control" name="solicitante" id="solicitante">
        </div>

        <div class="form-group py-2 col-12">
            <label for="animal" class="text-capitalize text-light">Nome <span class="text-lowercase">do</span> animal:</label>
            <input type="text" class="form-control" name="animal" id="animal" value="${pet.name}" disabled>
        </div>

        <div class="form-group py-2 col-6">
            <label for="cpf" class="text-capitalize text-light">CPF:</label>
            <input type="text" class="form-control" name="cpf" id="cpf">
        </div>

        <div class="form-group py-2 col-6">
            <label for="email" class="text-capitalize text-light">E-mail:</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>

        <div class="form-group py-2 col-6">
            <label for="cel" class="text-capitalize text-light">Celular:</label>
            <input type="text" class="form-control" name="cel" id="cel">
        </div>

        <div class="form-group py-2 col-6">
            <label for="nascimento" class="text-capitalize text-light">Data <span class="text-lowercase">de</span> Nascimento:</label>
            <input type="text" class="form-control" name="nascimento" id="nascimento">
        </div>

        <div class="col-12 d-flex justify-content-center mt-4">
            <button class="btn btn-custom-2">Solicitar</button>
        </div>`

    return html
}