import {AUTH_LARAVEL, AUTH_NODE, WS_URL, DEBUG, REACT_JS, REACT_TYPE, logoutCallback} from '../config';
import FormData from 'form-data'
const axios = require('axios').default;

function uploadBuild(dados, arquivos){
    if (arquivos != undefined && typeof arquivos == 'object'){
        let data = new FormData();
        for ( var key in dados ) {
            data.append(key, dados[key]);
        }

        for ( var key in arquivos ) {
            if ( Array.isArray(arquivos[key])){
                arquivos[key].map((file,i) => {
                    if (REACT_TYPE == REACT_JS){
                        data.append(key+"["+i+"]", file)
                    } else {
                        //só adiciona os elementos que tiverem fileName
                        if (file.fileName == undefined){
                            return;
                        }
                        data.append(key+"["+i+"]", {name:file.fileName,
                                                uri:file.uri,
                                                type:file.type})
                    }
                })
            } else {
                if (REACT_TYPE == REACT_JS){
                    data.append(key, arquivos[key])
                } else {
                    let fileData = {name:arquivos[key].fileName,
                        uri:arquivos[key].uri,
                        type:arquivos[key].type}
                    data.append(key, fileData);
                }
            }
        }
        return data;
    }
    return false;
}



export async function makeRequest(method,action,dados,arquivos){
    
    //Verifica se é uma chamada para uma url ou uma action
    let url = null;
    if (action.indexOf('http') > -1){
        url = action;
    } else {
        url = WS_URL+'/'+action;
    }

    //se for para debugar
    if (DEBUG){
        console.log("====Request=====");
        console.log(method + " " + url);
        console.log("\t" + JSON.stringify(dados));
    }    

    //Configura o header
    let headers = {'Accept':'application/json'};


    //Se constroi o conjunto de dados que será enviado
    //Isso é necessário caso haja upload de arquivos
    let newDados = uploadBuild(dados, arquivos);
    if (newDados != false){
        dados = newDados;
        headers['Content-Type'] = 'multipart/form-data';
    }


    if (localStorage.getItem("jwtToken") != null) {
        //Basic Authorization
        //headers = {'Authorization': 'Basic '+ base64.encode(global.wsUser+':'+global.wsPassword)};
        if (global.auth_header == AUTH_NODE){
            headers['x-access-token'] =  localStorage.getItem("jwtToken") //Node    
        } else
        if (global.auth_header == AUTH_LARAVEL){
            headers['Authorization']  = 'Bearer '+ localStorage.getItem("jwtToken") //Laravel
        }

        //se houver upload
        if (newDados != false){
            headers['Content-Type'] = 'multipart/form-data';
        }

        if (DEBUG){
            console.log("====Headers=====");
            console.log("\t" + JSON.stringify(headers))
        }
    }

    let erro = null;

    if (method.toUpperCase() == 'GET'){
        dados = new URLSearchParams(dados).toString();
        if (url.indexOf('?')>0){
            url += dados;
        } else {
            url += '?'+dados;
        }
    }

    //faz a requisicao
    const resp = await axios({
        method:method,
        url:url,
        data:dados,
        timeout: 3000,
        headers: headers
    }).catch(err => {
        console.log("====Response=====");
        console.log(err)
        erro = err;
        console.log("=================");
    });

    if (resp == undefined){
        //se isso ocorrer é porque está deslogado
        //pode ter perdido a sessao
        if (erro.response.status == 401){
            logoutCallback();
        } else 
        if (erro.response.status == 422) {
            //422 = erro de validacao
            return {error:1, message:erro, code:erro.response.status, errors:erro.response.data.errors};
        }
        return {error:1, message:erro, code:erro.response.status};
    }

    //se for para debugar
    if (DEBUG){
        console.log("====Response=====");
        console.log(resp.data);
        console.log("=================");
    }

    return resp.data
}

export async function getRemoteImage(path){
    let url = WS_URL + "/" + path;

    //Se for para debugar
    if (DEBUG){
        console.log("====Request=====");
        console.log("GET " + url);
    }

    //Configura o header
    let headers = {};
    if (localStorage.getItem("jwtToken") != null) {
        if (global.auth_header == AUTH_NODE){
            headers['x-access-token'] =  localStorage.getItem("jwtToken") //Node    
        } else
        if (global.auth_header == AUTH_LARAVEL){
            headers['Authorization']  = 'Bearer '+ localStorage.getItem("jwtToken") //Laravel
        }

        if (DEBUG){
            console.log("====Headers=====");
            console.log("\t" + JSON.stringify(headers))
        }
    }

    let erro = null;
    //faz a requisicao
    const resp = await axios({
        method:'GET',
        url:url,
        timeout: 5000,
        headers: headers,
        responseType: 'blob'
    }).catch(err => {
        console.log("====Response=====");
        console.log(err)
        erro = err;
        console.log("=================");
    });

    
    try{
        return new Promise(resolve => {
            const reader = new FileReader();
            reader.readAsDataURL(resp.data);
            reader.onloadend = () => {
            const base64data = reader.result;
            resolve(base64data);
            };
        });
    } catch(e){
        console.log("**Erro ao converter imagem para base64");
        console.log(e);
        return "";
    }
}
