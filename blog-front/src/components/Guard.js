import React from 'react';
import { Navigate } from 'react-router-dom';
 

export default function Guard({element: Component, ...rest}){

     let hasJWT = false;

     localStorage.getItem("jwtToken") ? hasJWT = true : hasJWT = false;
     
     console.log("hasJWT")
     console.log(hasJWT);

     if (hasJWT){
          return Component;
     } else {
          console.log("REDIRECIONA");
          return <Navigate to={{ pathname: '/login' }} />
     }
}
