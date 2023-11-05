var url = "http://127.0.0.1:8000/api/"
var id = new URLSearchParams(window.location.search).get("id")

window.addEventListener('load', () => {
    const card = document.querySelector('#card')
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
        card.innerHTML = cardPetHtml(res.pet)
    })
    .catch(error => {
        console.error('Ocorreu um erro:', error)
    });
})

function cardPetHtml(pet)
{
    const html = `<div class="container mb-5">
            <div class="row align-items-start">
                <div class="col-8 d-flex">
                    <div class="col-3 d-flex flex-wrap row-gap-3">
                        <div class="col-12 rounded overflow-hidden">
                            <img src="img/tini-2.webp" alt="Tini" class="object-fit-cover w-100" height="120">
                        </div>

                        <div class="col-12 rounded overflow-hidden">
                            <img src="img/tini-3.webp" alt="Tini" class="object-fit-cover w-100" height="120">
                        </div>

                        <div class="col-12 rounded overflow-hidden">
                            <img src="img/tini-4.webp" alt="Tini" class="object-fit-cover w-100" height="120">
                        </div>

                        <div class="col-12 rounded overflow-hidden">
                            <img src="img/tini-5.webp" alt="Tini" class="object-fit-cover w-100" height="120">
                        </div>
                    </div>

                    <div class="col-9 rounded overflow-hidden">
                        <img src="img/tini.webp" alt="Tini" class="object-fit-cover w-100 ms-3" height="530">
                    </div>
                </div>
                
                <div class="py-3 col-4 d-flex flex-wrap row-gap-3">                   
                    <h2 class="col-12 d-flex align-items-center gap-2">
                        ${pet.name} 

                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-gender-female" viewBox="0 0 16 16">
                            <path fill="#FF7373" fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z"/>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-gender-male" viewBox="0 0 16 16">
                            <path fill="#006AB0" fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                        </svg>
                    </h2>

                    <div class="col-12">
                        <h3 class="fs-sm destaque m-0">Código</h3> 
                        <div>${pet.id}</div>
                    </div>

                    <div class="col-6">
                        <h3 class="fs-sm destaque m-0">Espécie</h3> 
                        <div>Gato</div>
                    </div>

                    <div class="col-6">
                        <h3 class="fs-sm destaque m-0">Porte</h3> 
                        <div>${pet.size}</div>
                    </div>

                    <div class="col-12">
                        <h3 class="fs-sm destaque m-0">Raça</h3> 
                        <div>American Shorthair</div>
                    </div>

                    <div class="col-6">
                        <h3 class="fs-sm destaque m-0">Peso</h3> 
                        <div>5 Kg</div>
                    </div>

                    <div class="col-6">
                        <h3 class="fs-sm destaque m-0">Idade</h3> 
                        <div>3 anos</div>
                    </div>

                    <div class="col-12">
                        <h3 class="fs-sm destaque m-0">Local</h3> 
                        <div>Bom Retiro, Curitiba - PR</div>
                    </div>
                    
                    <div class="col-12">
                        <h3 class="fs-sm destaque m-0">Sobre</h3> 
                        <div>💖 Frajolinha Fêmea de narizinho rosa</div>
                    </div>

                    <div class="col-12">
                        <a href="formulario.html?id=${pet.id}" class="btn btn-custom mt-5 w-100 d-flex align-items-center justify-content-center gap-2">
                            Solicitar adoção

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>`

    return html
}