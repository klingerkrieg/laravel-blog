import { makeRequest } from '../components/Ws';

export async function getAll(){
    const json = await makeRequest('GET','api/produtos');
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}

export async function getOne(id){
    const json = await makeRequest('GET','api/produto/'+id);
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}


export async function salvar(dados){
    const json = await makeRequest('POST','api/produtos',dados);
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}

export async function atualizar(dados){
    const json = await makeRequest('PUT','api/produtos',dados);
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}

export async function deletar(id){
    const json = await makeRequest('DELETE','api/produtos',{id:id});
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}
