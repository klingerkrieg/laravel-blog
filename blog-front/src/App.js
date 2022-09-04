import logo from './logo.svg';
import './App.css';
import React, { Suspense, lazy } from 'react';
import {Navigate, Link, BrowserRouter as Router, Routes, Route } from 'react-router-dom';
//import { ProvideAuth, PrivateRoute, AuthButton } from './components/AuthRoutes';
import { createBrowserHistory } from 'history';
import Guard from './components/Guard';
 
export const history = createBrowserHistory();

const Login = lazy(() => import('./views/Login'));
const Home = lazy(() => import('./views/Home'));
const Dashboard = lazy(() => import('./views/interno/Dashboard'));
const ProdutosList = lazy(() => import('./views/interno/ProdutosList'));
const Produto = lazy(() => import('./views/interno/Produto'));


const App = () => (
  <Router history={history}>
    <Suspense fallback={<div>Carregando...</div>}>

      <Routes>
        <Route path="/" element={<Login/>} />
        <Route path="/login" element={<Login/>} />
        <Route path="/home" element={<Home/>} />
        <Route path="/dashboard" element={<Guard element={<Dashboard/>}/>} />
        <Route path="/produtos" element={<Guard element={<ProdutosList/>}/>} />
        <Route path="/produto/:id" element={<Guard element={<Produto/>}/>} />
        <Route path="/produto" element={<Guard element={<Produto/>}/>} />
      </Routes>

    </Suspense>
  </Router>
);

export default App;
