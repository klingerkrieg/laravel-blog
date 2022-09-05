import { makeRequest } from '../components/Ws';

export async function login(dados, saveLogin){
    const json = await makeRequest('POST','api/login',dados);

    if (json.error == 0){
        //localStorage.getItem("jwtToken") = json.access_token
        localStorage.setItem("jwtToken", json.access_token)
        /*if (saveLogin){
            await AsyncStorage.setItem('@token', localStorage.getItem("jwtToken"))
        } else {
            await AsyncStorage.removeItem('@token');
        }*/
        return json;
    } else {
        return json;
    }    
}

export async function logout(){
    localStorage.removeItem("jwtToken");
    axios.post(WS_URL+"api/logout").then(resp => {
        console.log(resp);
    });
    axios.defaults.headers = {
        'Accept': 'application/json'
    };
}


export async function register(dados){
    const json = await makeRequest('POST','api/register',dados);
    return json;
    
}


export async function forgotPassword(dados){
    const json = await makeRequest('POST','api/forgotPassword',dados);
    return json;
    
}


export async function redefinePassword(dados){
    const json = await makeRequest('POST','api/redefinePassword',dados);
    return json;
    
}


export async function checkToken(){
    if (localStorage.getItem("jwtToken") != undefined && localStorage.getItem("jwtToken") != null){
        const json = await makeRequest('POST','api/me');
        console.log(json);
        if (json.error == true){
            console.log("logout")
            logout();
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
    
}