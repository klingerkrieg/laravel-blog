import React, { useImperativeHandle, useState } from 'react';
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';

//export default function ConfirmModal(props){
const ConfirmModal = React.forwardRef((props, ref) => {

    const [show, setShow] = useState(false);
    //var _item = null;
    const [_item, _setItem] = useState(null);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    let message = "Você realmente deseja deletar este registro?";
    if (props.message != undefined){
        message = props.message;
    }

    const _confirmButton = () => {
        props.onConfirm(_item);
        handleClose();
    }

    useImperativeHandle(ref, () => ({
        show(){
            handleShow();
        },
        setItem(item){
            console.log(item);
            _setItem(item);
        }
      }));

    return <Modal show={show} onHide={handleClose}>
                <Modal.Header closeButton>
                <Modal.Title>Confirmação</Modal.Title>
                </Modal.Header>

                <Modal.Body>
                <p>{message}</p>
                </Modal.Body>

                <Modal.Footer>
                <Button variant="secondary" onClick={handleClose}>Cancelar</Button>
                <Button variant="danger" onClick={_confirmButton}>Sim</Button>
                </Modal.Footer>
            </Modal>
    
});

export default ConfirmModal;