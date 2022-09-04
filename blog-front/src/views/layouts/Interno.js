import Menu from "../Menu"
import Helmet from 'react-helmet';

// O include do css veio para cá
import '../../css/styles.css'

export default function Externo(props){
    return (<><Helmet>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="" />
                <meta name="author" content="" />
                <title>Clean Blog - Start Bootstrap Theme</title>
                <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
                {/* Font Awesome icons (free version) */}
                <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
                {/* Google fonts */}
                <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
                {/* Core theme CSS (includes Bootstrap) 
                O include do CSS foi la pra cima */}

                {/*<script src="js/jquery-3.6.0.js"></script>
                <script src="js/jquery.mask.min.js"></script>*/}
            </Helmet>
                
                
                <Menu></Menu>

                <header className="masthead interno" 
                    style={{backgroundImage: 'url("assets/img/home-bg.jpg")'}}>
                </header>

                {props.children}
                
                <footer className="border-top">
                    <div className="container px-4 px-lg-5">
                        <div className="row gx-4 gx-lg-5 justify-content-center">
                            <div className="col-md-10 col-lg-8 col-xl-7">
                                <ul className="list-inline text-center">
                                    <li className="list-inline-item">
                                        <a href="#!">
                                            <span className="fa-stack fa-lg">
                                                <i className="fas fa-circle fa-stack-2x"></i>
                                                <i className="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li className="list-inline-item">
                                        <a href="#!">
                                            <span className="fa-stack fa-lg">
                                                <i className="fas fa-circle fa-stack-2x"></i>
                                                <i className="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li className="list-inline-item">
                                        <a href="#!">
                                            <span className="fa-stack fa-lg">
                                                <i className="fas fa-circle fa-stack-2x"></i>
                                                <i className="fab fa-github fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div className="small text-center text-muted fst-italic">Copyright &copy; Your Website 2021</div>
                            </div>
                        </div>
                    </div>
                </footer>
            </>)

}

/*

                <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
                <script src="{{asset('clean-blog/js/scripts.js')}}"></script>*/