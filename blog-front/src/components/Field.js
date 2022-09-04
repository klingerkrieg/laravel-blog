import Figure from 'react-bootstrap/Figure';

export default function Field(props){

    let id = props.id
    if (id == undefined){
        id = props.name;
    }

    let classes = "form-control";
    if (props.error != undefined){
        classes += " is-invalid";
    }

    let onChange = (text) => {
        if (props.onChange){
            props.onChange(text)
        }
    }


    let input = "";
    if (props.type == "image" || props.type == "file"){
        input = <><input id={props.id} type="file" 
                        className={classes} 
                        name={props.name}
                        required={props.required}
                        onChange={onChange}
                        disabled={props.disabled}
                        />
                    {(props.type == "image" 
                        && props.value != ""  
                        && props.value != undefined  
                        && props.value != null ) && 
                    <Figure>
                        <Figure.Image
                            width={200}
                            src={props.value}/>
                    </Figure>
                    }
                </>
    } else
    if (props.type == "textarea"){
        input = <textarea id={props.id}
                className={classes} 
                name={props.name} value={props.value}
                required={props.required}
                onChange={onChange}
                disabled={props.disabled}></textarea>
    } else {
        input = <input id={props.id} type={props.type} 
                        className={classes} 
                        name={props.name} value={props.value}
                        required={props.required}
                        autoFocus={props.autofocus} 
                        readOnly={props.readOnly}
                        onChange={onChange}
                        disabled={props.disabled}
                        />
    }

    


    return (<div className="row mb-3">
                <label htmlFor={props.id} className="col-md-4 col-form-label text-md-right">
                    {props.label}
                </label>

                <div className="col-md-6">
                    {input}

                    { props.error &&
                        <span className="invalid-feedback" role="alert">
                            <strong> {props.error} </strong>
                        </span>
                    }
                </div>
            </div>)
}