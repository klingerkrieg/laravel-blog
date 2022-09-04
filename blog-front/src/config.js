//mobile
//export const ws_URL      = "http://10.0.2.2:8000";
export const WS_URL        = "http://localhost:8000";
//export const wsUser      = "admin";
//export const wsPassword  = "123456";
export const DEBUG         = true;

// Forma de envio do cabeçalho
export const AUTH_LARAVEL = 1; //Authorization:Bearer {token}
export const AUTH_NODE    = 2; //x-access-token:{token}

global.auth_header = AUTH_LARAVEL;

