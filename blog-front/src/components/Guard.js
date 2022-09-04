import React from 'react';
import { Route, Navigate } from 'react-router-dom';
 

//const Guard = ({ element: Component, ...rest }) => {
export default function Guard({element: Component, ...rest}){

     let hasJWT = false;

     localStorage.getItem("jwtToken") ? hasJWT = true : hasJWT = false;
     //check user has JWT token
     //localStorage.getItem("token") ? flag=true : flag=false
          
     if (hasJWT){
          return Component;
     } else {
          return <Navigate to={{ pathname: '/login' }} />
     }
}
