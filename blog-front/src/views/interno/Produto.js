import { useEffect, useRef, useState } from "react";
import Interno from "../layouts/Interno"
import Field from "../../components/Field";
import ConfirmModal from "../../components/ConfirmModal";
import { Link, useNavigate, useParams } from "react-router-dom";
import * as ProdutosController from '../../controllers/Produtos'
import { FlashMessage } from "../../components/FlashMessage";

export default function Produto (props){

    const navigate = useNavigate();
    let { id } = useParams(null);
    const [dados, setDados] = useState({id:null, name:'',publish_date:'',text:''});
    const [errors, setErrors] = useState({});
    const [image, setImage] = useState(null);
    const [imageUpload, setImageUpload] = useState(null);
    const confirmModal = useRef();
    const flash = useRef();

    useEffect(() => {
        if (id != undefined){
            ProdutosController.getOne(id).then(resp => {
                if (resp.error == 0){
                    setDados(resp.data);
                    setImage(resp.data.image);
                } else {
                    flash.current.setError("Erro ao recuperar produto");
                }
            });
        }
    },[]);

    const clear = () => {
        setDados({id:null, name:'',publish_date:'',text:''})
        setImage(null);
        setImageUpload(null);
        navigate('/produto');
    }


    const deletarItem = (item) => {
        ProdutosController.deletar(item.id).then(resp => {
            if (resp.error == 0){
                navigate('/produtos');
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

    let canCreate = true;
    let canUpdate = true;
    let canDelete = false;
    if (id != undefined){
        canDelete = true;
    }

    const handleInput = (evt) => {
        if (evt.target.type == 'file') {
            setImage(URL.createObjectURL(evt.target.files[0]));
            setImageUpload(evt.target.files[0]);
        } else {
            let name = evt.target.name;
            let value = evt.target.value;
            setDados({...dados, [name]:value});
        }
    }

    const handleSubmit = (evt) => {

        const submitCallback = (resp) => {
            if (resp.error == 0){
                flash.current.setSuccess(resp.message);
                if (resp.id != undefined)
                    navigate('/produto/'+resp.id);
            } else {
                if (resp.code == 422){
                    setErrors(resp.errors);
                } else {
                    flash.current.setError("Falha ao salvar");
                }
            }
        }

        let arquivos = {}
        if (imageUpload != null){
            arquivos['image'] = imageUpload;
        }

        let postData = ['id', 'name','publish_date','text'];
        postData = Object.assign({}, ...postData.map((key)=>{
            return {[key]:dados[key]};
        }));

        evt.preventDefault();
        if (dados.id != null){
            ProdutosController.atualizar(postData,arquivos).then(submitCallback)
        } else {
            delete postData['id'];
            ProdutosController.salvar(postData,arquivos).then(submitCallback)
        }
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

                        
                        <form id="main" onSubmit={handleSubmit}>

                        {id != null && dados.user &&
                            <Field label="Dono" 
                                   value={dados.user.name} 
                                   name="dono"
                                   disabled={true} ></Field>
                        }
                        
                        <Field label="Nome" 
                                   value={dados.name} 
                                   name="name"
                                   onChange={(evt) => handleInput(evt)}
                                   error={errors.name}
                                   required={true} ></Field>
                        
                        <Field label="Data de publicação" 
                                   value={dados.publish_date} 
                                   name="publish_date"
                                   onChange={(evt) => handleInput(evt)}
                                   error={errors.publish_date}
                                   type="date"></Field>

                        <Field label="Foto" 
                                   name="image"
                                   value={image}
                                   onChange={(evt) => handleInput(evt)}
                                   error={errors.image}
                                   type="image"></Field>

                        <Field label="Slug" 
                                   value={dados.slug} 
                                   name="slug"
                                   onChange={(evt) => handleInput(evt)}
                                   error={errors.slug}
                                   readOnly={true}></Field>

                        <Field label="Texto" 
                                   value={dados.text} 
                                   name="text"
                                   onChange={(evt) => handleInput(evt)}
                                   error={errors.text}
                                   type="textarea"></Field>

                        </form>
                            
                            <div className="row mb-0">
                                <div className="col-md-8 offset-md-4">
                                    {(canCreate || canUpdate) &&
                                        <button type="submit" className="btn btn-primary" form="main">
                                            Save
                                        </button>
                                    }
                                    
                                    {canCreate &&
                                        <button className="btn btn-secondary" onClick={clear}>
                                            Novo produto
                                        </button>
                                    }

                                    {canDelete && 
                                        <button type="button" onClick={() => confirmDeleteModal(dados)} className="btn btn-danger">
                                            Deletar
                                        </button>
                                    }
                                </div>
                            </div>
                    </div>
                </div>
                </div>
                </div>
                </div>
            </Interno>
}