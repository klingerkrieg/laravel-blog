import { Link, useNavigate } from "react-router-dom"
import { logout } from "../controllers/Auth";


export default function Menu(){

    const navigate = useNavigate();

    const logoutClick = () => {
        logout();
        navigate("/");
    }

    let loginLogout = <li className="nav-item"><Link className="nav-link px-lg-3 py-3 py-lg-4" to="/login">Login</Link></li>;
    if (localStorage.getItem("jwtToken") != undefined){
        //MENU LOGADO

        loginLogout = <li className="nav-item"><a href="#" className="nav-link px-lg-3 py-3 py-lg-4" onClick={logoutClick}>Logout</a></li>
    
        return (<nav className="navbar navbar-expand-lg navbar-light" id="mainNav">
                        <div className="container px-4 px-lg-5">
                            <Link className="navbar-brand" to="/">Start Bootstrap</Link>
                            <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                                Menu
                                <i className="fas fa-bars"></i>
                            </button>
                            <div className="collapse navbar-collapse" id="navbarResponsive">
                                <ul className="navbar-nav ms-auto py-4 py-lg-0">
                                    <li className="nav-item"><Link className="nav-link px-lg-3 py-3 py-lg-4" to="/produtos">Produtos</Link></li>

                                    {loginLogout}
                                </ul>
                            </div>
                        </div>
                    </nav>)

    } else {
        //MENU DESLOGADO
        return (<nav className="navbar navbar-expand-lg navbar-light" id="mainNav">
                        <div className="container px-4 px-lg-5">
                            <Link className="navbar-brand" to="/">Start Bootstrap</Link>
                            <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                                Menu
                                <i className="fas fa-bars"></i>
                            </button>
                            <div className="collapse navbar-collapse" id="navbarResponsive">
                                <ul className="navbar-nav ms-auto py-4 py-lg-0">
                                    <li className="nav-item"><Link className="nav-link px-lg-3 py-3 py-lg-4" to="/home">Home</Link></li>
                                    <li className="nav-item"><Link className="nav-link px-lg-3 py-3 py-lg-4" to="/about">About</Link></li>
                                    <li className="nav-item"><Link className="nav-link px-lg-3 py-3 py-lg-4" to="/products">Sample</Link></li>
                                    <li className="nav-item"><Link className="nav-link px-lg-3 py-3 py-lg-4" to="/contact">Contact</Link></li>

                                    {loginLogout}
                                </ul>
                            </div>
                        </div>
                    </nav>)
    }
}