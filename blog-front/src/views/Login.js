import { useState } from 'react';
import { useNavigate, Navigate } from 'react-router-dom';
import Field from '../components/Field';
import { login } from '../controllers/Auth';
import Interno from './layouts/Interno';


export default function Login(){

    const [dados, setDados] = useState({email:'',password:''});
    const navigate = useNavigate();

    const handleInput = (evt) => {
        let name = evt.target.name;
        let value = evt.target.value;
        setDados({...dados, [name]:value});
    }

    const handleSubmit = (evt) => {
        console.log(dados);
        evt.preventDefault();

        login(dados).then(resp => {
            console.log(resp);
            navigate("/dashboard");
        });
    }
    
    if (localStorage.getItem("jwtToken") != null) {
        return <Navigate to="/home"></Navigate>
    } else {

        return (
            <Interno title="Teste">

            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <form onSubmit={handleSubmit}>
                                <div className="card-header">Login</div>

                                <div className="card-body">
                                
                                    <Field name="email" type="email" label="E-mail"
                                            value={dados.email} 
                                            onChange={(evt) => handleInput(evt)}/>

                                    <Field name="password" type="password" label="Senha"
                                            value={dados.password} 
                                            onChange={(evt) => handleInput(evt)}/>

                                    <div className="row mb-0">
                                        <div className="col-md-8 offset-md-4">

                                            <button type="submit" className="btn btn-primary" click="">
                                                Login
                                            </button>
                                            
                                            <a className="btn btn-link" href="password.request">
                                                Forgot Your Password?
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </Interno>
            )
    }
}