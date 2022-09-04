import Interno from "../layouts/Interno"
import * as ProdutosController from '../../controllers/Produtos';
import { useEffect, useRef, useState } from "react";
import Field from "../../components/Field";
import { Link } from "react-router-dom";
import ConfirmModal from "../../components/ConfirmModal";

export default function Produtos (){

    let canView = true;
    let canDelete = true;

    const [dados, setDados] = useState({email:'',password:''});
    const [list, setList] = useState({data:[]});
    const [loading, setLoading] = useState(true);
    const confirmModal = useRef();

    useEffect(() => {
        loadList();
    },[]);

    const loadList = () => {
        setLoading(true);
        ProdutosController.getAll().then(resp => {
            if (resp.error == 0){
                setList(resp.data);
            } else {
                console.log("Falha ao buscar os dados");
            }
            setLoading(false);
        })
    }

    const handleInput = (evt) => {
        let name = evt.target.name;
        let value = evt.target.value;
        setDados({...dados, [name]:value});
    }

    const handleSubmit = (evt) => {
        console.log(dados);
        evt.preventDefault();

        loadList();
    }

    const deletarItem = (item) => {
        ProdutosController.deletar(item.id).then(resp => {
            if (resp.error == 0){
                loadList();
            } else {
                console.log("Falha ao deletar");
            }
        })
    }

    const confirmDeleteModal = (item) =>{
        confirmModal.current.show();
        confirmModal.current.setItem(item);
    }


    return <Interno>
                <ConfirmModal ref={confirmModal} onConfirm={deletarItem}></ConfirmModal>
                <div className="container">
                <div className="row justify-content-center">
                <div className="col-md-8">
                <div className="card">
                    <div className="card-header">Produtos</div>

                    <div className="card-body">
                        <form method="GET" onSubmit={handleSubmit}>
                            
                            <Field name="name" type="text" label="Nome"
                                            value={dados.name} 
                                            onChange={(evt) => handleInput(evt)}/>

                            <Field name="publish_date" type="text" label="Data de publicação"
                                            value={dados.publish_date} 
                                            onChange={(evt) => handleInput(evt)}/>

                            <Field name="text" type="text" label="Texto"
                                            value={dados.text} 
                                            onChange={(evt) => handleInput(evt)}/>
                            
                            <div className="row mb-0">
                                <div className="col-md-8 offset-md-4">
                                    <button type="submit" className="btn btn-primary">
                                        Buscar
                                    </button>

                                    <Link to='/produto' className="btn btn-primary">
                                        Novo Produto
                                    </Link>
                                </div>
                            </div>
                        </form>

                        <table className="table">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nome</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Data de publicação</th>
                                <th scope="col">Texto</th>
                                <th scope="col">Dono</th>
                                {canDelete &&
                                    <th scope="col"></th>
                                }
                            </tr>
                            </thead>
                            <tbody>
                            
                            {loading ?
                                <tr>
                                    <td colSpan={5}>
                                        Carregando...
                                    </td>
                                </tr>
                                :
                            
                                list.data.map((item,k)=> {
                                    
                                    return <tr key={k}>
                                        {canView &&
                                            <td>
                                                //passar o parametro
                                                <Link to="/produto/" className="btn btn-primary">
                                                    Editar
                                                </Link>
                                            </td>
                                        }
                                        <td>{item.name}</td>
                                        <td>{item.slug}</td>
                                        <td>{item.publish_date}</td>
                                        <td>{item.text}</td>
                                        <td>{item.user.name}</td>

                                        {canDelete && 
                                            <td>
                                                <button type="button" onClick={() => confirmDeleteModal(item)} className="btn btn-danger">
                                                    Deletar
                                                </button>
                                            </td>
                                        }
                                    </tr>
                                })
                            }
                            </tbody>
                        </table>

                        PAGINACAO

                    </div>
                </div>
                </div>
                </div>
                </div>
            </Interno>
}