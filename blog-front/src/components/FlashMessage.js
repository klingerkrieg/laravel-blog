import React, { useImperativeHandle, useState } from "react"
import Alert from 'react-bootstrap/Alert';

export const FlashMessage = React.forwardRef((props, ref) => {

    const [_message, _setMessage] = useState(null);
    const [_variant, _setVariant] = useState('danger');

    /** Permite o uso dessas funcoes atraves do ref.current */
    useImperativeHandle(ref, () => ({
        setError(val){
            _setMessage(val);
            _setVariant('danger');
        },
        setWarning(val){
            _setMessage(val)
            _setVariant('warning');
        },
        setSuccess(val){
            _setMessage(val)
            _setVariant('success');
        },
      }));
    
    return <div className="row justify-content-center">
            <div className={props.className}>
                {_message &&
                    <Alert variant={_variant}>
                        {_message}
                    </Alert>
                }
            </div>
        </div>
});