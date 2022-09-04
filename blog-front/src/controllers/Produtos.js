import { makeRequest } from '../components/Ws';

export async function getAll(url,dados){
    if (url == undefined){
        url = 'api/produtos'
    }
    const json = await makeRequest('GET',url,dados);
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}

export async function getOne(id){
    const json = await makeRequest('GET','api/produtos/'+id);
    if (json.error == 0){
        json.data.publish_date = json.data.publish_date.substr(0,10);
        return json;
    } else {
        return json;
    }    
}


export async function salvar(dados,arquivos){
    const json = await makeRequest('POST','api/produtos',dados,arquivos);
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}

export async function atualizar(dados,arquivos){
    const json = await makeRequest('POST','api/produtos/upd',dados,arquivos);
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}

export async function deletar(id){
    const json = await makeRequest('DELETE','api/produtos/'+id);
    if (json.error == 0){
        return json;
    } else {
        return json;
    }    
}
