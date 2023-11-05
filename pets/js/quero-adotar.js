var url = "http://127.0.0.1:8000/api/"

window.addEventListener('load', () => {
    const cards = document.querySelector('#cards')
    const config = {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json'
        }
    };
    fetch(`${url}getPets`, config)
    .then(response => {
        if (!response.ok) {
        throw new Error(`Erro na solicitação: ${response.status}`)
        }
        return response.json() 
    })
    .then(res => {
        res.forEach(data => {
            console.log(data.img_header.split('/')[1])
            cards.innerHTML += petCardHtml(data);
        });
    })
    .catch(error => {
        console.error('Ocorreu um erro:', error)
    });
})

function petCardHtml(pets){
    let html = `<div class="col-xxl-3 col-4">
        <div class="card rounded overflow-hidden">
            <a href="integra.html">
                <img src="${pets.img_header.split('/')[1]}" alt="" class="w-100 object-fit-cover" height="320">
            </a>

            <div class="p-3">
                <p class="m-0 fs-sm">Cód. ${pets.id}</p>

                <div class="d-flex align-items-center gap-2 mt-2 py-2">
                    <h3 class="h4 m-0">${pets.name}</h3>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gender-male" viewBox="0 0 16 16">
                        <path fill="#006AB0" fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                    </svg>
                </div>

                <p class="mb-4 fs-md">${pets.street}, ${pets.neighborhood} - ${pets.state}</p>

                <a href="integra.html?id=${pets.id}" class="btn btn-custom-2 d-flex align-items-center justify-content-center gap-2 w-100">
                    Quero Adotar

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>`
    return html
}