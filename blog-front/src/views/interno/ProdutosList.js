import Interno from "../layouts/Interno"
import * as ProdutosController from '../../controllers/Produtos';
import { useEffect, useRef, useState } from "react";
import Field from "../../components/Field";
import { Link } from "react-router-dom";
import ConfirmModal from "../../components/ConfirmModal";
import { PaginateList } from "../../components/PaginateList";
import { FlashMessage } from "../../components/FlashMessage";

export default function Produtos (){

    let canView = true;
    let canDelete = true;

    const [dados, setDados] = useState({name:'',publish_date:'',text:''});
    const list = useRef();
    const confirmModal = useRef();
    const flash = useRef();

    useEffect(() => {
        list.current.update();
    },[]);

    const loadList = (url) => {
        list.current.setRefreshing(true);
        ProdutosController.getAll(url,dados).then(resp => {
            if (resp.error == 0){
                list.current.setData(resp.data);
            } else {
                console.log("Falha ao buscar os dados");
            }
            list.current.setRefreshing(false);
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
                flash.current.setWarning(resp.message);
            } else {
                flash.current.setError("Falha ao deletar");
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

                <FlashMessage ref={flash}></FlashMessage>

                <div className="row justify-content-center">
                <div className="col-md-12">
                <div className="card">
                    <div className="card-header">Produtos</div>

                    <div className="card-body">
                        <form method="GET" onSubmit={handleSubmit}>
                            
                            <Field name="name" type="text" label="Nome"
                                            value={dados.name} 
                                            onChange={(evt) => handleInput(evt)}/>

                            <Field name="publish_date" type="date" label="Data de publicação"
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

                        <PaginateList
                            ref={list}
                            update={loadList}
                            columns={["","Nome","Slug","Data de publicação",
                                      "Texto","Dono","Deletar"]}
                            item={(item, k) => <tr key={k}>
                                <td>
                                    {canView &&
                                        <Link to={'/produto/'+item.id} className="btn btn-primary">
                                            Editar
                                        </Link>
                                    }
                                </td>
                                <td>{item.name}</td>
                                <td>{item.slug}</td>
                                <td>{item.publish_date.substr(0,10)}</td>
                                <td>{item.text}</td>
                                <td>{item.user.name}</td>
                                <td>
                                    {canDelete && 
                                        <button type="button" onClick={() => confirmDeleteModal(item)} className="btn btn-danger">
                                            Deletar
                                        </button>
                                    }
                                </td>
                                </tr>}
                        ></PaginateList>

                    </div>
                </div>
                </div>
                </div>
                </div>
            </Interno>
}