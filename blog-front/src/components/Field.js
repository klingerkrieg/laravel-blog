

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

    return (<div className="row mb-3">
                <label htmlFor={props.id} className="col-md-4 col-form-label text-md-right">
                    {props.label}
                </label>

                <div className="col-md-6">
                    <input id={props.id} type={props.type} 
                            className={classes} 
                            name={props.name} value={props.value}
                            required={props.required}
                            autoFocus={props.autofocus} 
                            onChange={onChange}
                            />

                    { props.error &&
                        <span className="invalid-feedback" role="alert">
                            <strong> {props.error} </strong>
                        </span>
                    }
                </div>
            </div>)
}