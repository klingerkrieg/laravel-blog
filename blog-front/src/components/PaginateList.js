import React, { useImperativeHandle, useState } from "react";
import Pagination from 'react-bootstrap/Pagination';
import Table from 'react-bootstrap/Table';

export const PaginateList = React.forwardRef((props, ref) => {

    const [refreshing, _setRefreshing] = useState(false);
    const [items, _setItems] = useState([]);
    const [pagination, _setPagination] = useState(
        {
            from:1,
            current_page:1,
            last_page:1,
            total:0,
            links:null,
            first_page_url:null,
            last_page_url:null,
            next_page_url:null,
            prev_page_url:null,
        });

    

    const _update = props.update.bind(this);

    /** Permite o uso dessas funcoes atraves do ref.current */
    useImperativeHandle(ref, () => ({
      update(){
        _update();
      },
      setRefreshing(val){
        _setRefreshing(val)
      },
      setData(val){
        _setItems(val.data);
        let pag = val;
        delete pag['data'];
        _setPagination(pag);
      },
    }));


    let columns = [];
    if (props.columns != undefined){
        columns = props.columns;
    }
    let tableHead = <thead>
                    <tr>
                        {columns.map((col, k) => (
                            <th key={k}>{col}</th>
                        ))}
                    </tr>
                    </thead>

    let tableBody = <tbody>
                        {items.map((item,k) => {
                            return props.item(item,k)
                        })}
                    </tbody>

    if (refreshing){
        tableBody = <tbody><tr><td colSpan={columns.length}>Carregando...</td></tr></tbody>
    }
    if (items.length == 0){
        tableBody = <tbody><tr><td colSpan={columns.length}>Nenhum dado encontrado.</td></tr></tbody>
    }

    let pages = [];
    if (pagination.last_page > 1 ){
        pages = pagination.links.map((page, k)=>{
            return <Pagination.Item key={k} onClick={() => _update(page.url)} 
                            active={page.label == pagination.current}
                            >
                            <span dangerouslySetInnerHTML={{ __html: page.label }}></span>
                    </Pagination.Item>
        });
    }

    let tableFoot = <tfoot>
                    <tr>
                        <td colSpan={columns.length}>
                                <Pagination>{pages}</Pagination>
                        </td>
                    </tr>
                </tfoot>

    return <Table responsive>
            {tableHead}
            {tableBody}
            {tableFoot}
            </Table>

    
});
