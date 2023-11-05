<div>
    <h1 class="title">Solicitação de adoção do pet {{ $notify['pet']['name'] }}</h1>
    <h2 class="sub-title">Informações</h2>
    <h4>Nome: {{ $notify['pet']['name'] }}</h4>
    <h4>Idade: {{ $notify['pet']['age'] }}</h4>
    <h4>Porte: {{ $notify['pet']['size'] }}</h4>
    <h4>Sobre: {{ $notify['pet']['desc_pets'] }}</h4>
</div>

<style>
    .title {
        text-align: center;
    },
    .subtitle {
        margin-top: 5%;
        margin-bottom: 2%
    }
</style>