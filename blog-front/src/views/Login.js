import { useRef, useState } from 'react';
import { useNavigate, Navigate } from 'react-router-dom';
import Field from '../components/Field';
import { login } from '../controllers/Auth';
import Interno from './layouts/Interno';
import { FlashMessage } from '../components/FlashMessage';

export default function Login(){

    const [dados, setDados] = useState({email:'',password:''});
    const [errors, setErrors] = useState({});

    const flash = useRef();

    const navigate = useNavigate();

    const handleInput = (evt) => {
        let name = evt.target.name;
        let value = evt.target.value;
        setDados({...dados, [name]:value});
    }

    const showError = (msg) => {
        console.log(msg);
        if (msg.code == 422){
            setErrors(msg.errors);
        } else
        if (msg.code == 401){
            flash.current.setError("Usuário ou senha incorreta.");
            setErrors({});
        } else {
            flash.current.setError("Houve uma falha ao tentar logar.");
            setErrors({});
        }
    }

    const handleSubmit = (evt) => {
        evt.preventDefault();

        login(dados).then(resp => {
            if (resp.error == 0){
                navigate("/dashboard");
            } else {
                showError(resp);
            }
        });
    }
    
    if (localStorage.getItem("jwtToken") != null) {
        return <Navigate to="/home"></Navigate>
    } else {

        return (
            <Interno title="Teste">
            <div className="container">

            <FlashMessage ref={flash} className="col-md-8"></FlashMessage>
            
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <form onSubmit={handleSubmit}>
                                <div className="card-header">Login</div>

                                <div className="card-body">
                                
                                    <Field name="email" type="email" label="E-mail"
                                            value={dados.email} 
                                            error={errors.email}
                                            onChange={(evt) => handleInput(evt)}/>

                                    <Field name="password" type="password" label="Senha"
                                            value={dados.password} 
                                            error={errors.password}
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