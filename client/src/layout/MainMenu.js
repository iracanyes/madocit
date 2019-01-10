/**
 * Author: iracanyes
 * Date: 11/19/18
 * Description:
 */
import React, {Component, Fragment} from "react";
import {ConnectedRouter, push} from 'connected-react-router';
import {connect, Provider} from 'react-redux';
import {
    Collapse,
    Navbar,
    NavbarToggler,
    NavbarBrand,
    Nav,
    NavItem,
    NavLink,
    UncontrolledDropdown,
    DropdownToggle,
    DropdownMenu,
    DropdownItem,
    Button,
    Form,
    FormGroup,
    Label,
    Input
} from 'reactstrap';
import ReactDOM from "react-dom";
import {Switch} from "react-router-dom";


class MainMenu extends Component
{
    constructor(props)
    {
        super(props);

        this.toggle = this.toggle.bind(this);
        this.state = {
            isOpen: true
        };
    }

    toggle()
    {
        this.setState({
            isOpen: !this.state.isOpen
        });
    }

    render()
    {
        return <Fragment>
            <Navbar color={"bg-primary"} dark expand={"lg"}   id="navbar-primary" className="navbar navbar-expand-lg navbar-dark bg-primary">
                {/* Navbar brand*/}
                <NavbarBrand href="/" className="col-lg-3">MaDocIt</NavbarBrand>


                <Form inline className="col-lg-5">
                    <Input className="form-control mr-sm-2 col-lg-9" type='search' aria-label='Search' placeholder="Recherche"/>
                    <Button outline color="primary" className={"my-2 my-sm-0"}><i className="fa fa-search" ></i></Button>
                </Form>


                <NavbarToggler onClick={this.toggle} />
                <Collapse isOpen={this.state.isOpen} navbar>
                    <Nav className="ml-auto" navbar>
                        <NavItem>
                            <NavLink href="/homepage/">Accueil</NavLink>
                        </NavItem>
                        <UncontrolledDropdown nav inNavbar>
                            <DropdownToggle nav caret>
                                Documentation
                            </DropdownToggle>
                            <DropdownMenu right>
                                <DropdownItem>
                                    <NavLink href="/categories">Catégories</NavLink>
                                </DropdownItem>
                                <DropdownItem>
                                    <NavLink href='/themes'>Thèmes</NavLink>
                                </DropdownItem>
                                <DropdownItem divider />
                                <DropdownItem>
                                    <NavLink href="/videos">Vidéos</NavLink>
                                </DropdownItem>
                            </DropdownMenu>
                        </UncontrolledDropdown>
                        <NavItem>
                            <NavLink href="/chat">Chat</NavLink>
                        </NavItem>
                        <NavItem>
                            <NavLink href="/apropos">A propos</NavLink>
                        </NavItem>

                    </Nav>
                </Collapse>
                {/*
                <a className="navbar-brand col-lg-2" href="#">MaDocIT</a>

                <button className="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarMainDropdown" aria-controls="navbarMainDropdown" aria-expanded="false"
                        aria-label="Menu principal">
                    <span className="navbar-toggler-icon"></span>
                </button>
                */}
                {/*
                <div className="col-lg-7 collapse navbar-collapse" id="navbarMainDropdown">
                    <ul className="navbar-nav">
                        <li className="nav-item active">
                            <a className="nav-link" href={"homepage"} onClick={()=> this.props.push("/home")}><i className="fa fa-fw fa-home"></i>Accueil<span
                                className="sr-only">(current)</span></a>
                        </li>
                        <li className="nav-item dropdown">
                            <a className="nav-link dropdown-toggle" href="documentation"
                               id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i className="fas fa-layer-group"></i>Documentation
                            </a>
                            <div className="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                <a className="dropdown-item" href="categories" onClick={()=> this.props.push('/categories') }>Catégories</a>
                                <a className="dropdown-item" href="themes" onClick={()=> this.props.push('/themes') }>Thèmes</a>
                                <a className="dropdown-item" href="videos" onClick={()=> this.props.push('/videos') }>Videos</a>
                            </div>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="chat" onClick={()=> this.props.push('/chat')}><i className="far fa-comments"></i>Chat</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="contact" onClick={() => this.props.push('/apropos')}><i className="fas fa-at"></i>A propos</a>
                        </li>
                        <li className="nav-item dropdown">
                            <a className="nav-link dropdown-toggle" href="documentation.html"
                               id="navbarDropdownMenuProfileMain" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i className="fas fa-user"></i>Membre
                            </a>
                            <div className="dropdown-menu" aria-labelledby="navbarDropdownMenuProfileMain">
                                <a className="dropdown-item" href="login.html" onClick={() => this.props.push('/login')}>Connexion</a>
                                <a className="dropdown-item" href="profile.html" onClick={()=> this.props.push('/profile')}>Profile</a>
                                <a className="dropdown-item" href="article.html" onClick={() => this.props.push('/logout')}>Déconnexion</a>
                            </div>
                        </li>
                    </ul>
                </div>
                */}

            </Navbar>
        </Fragment>
    }
}

const mapStateToProps = state => ({
    search: state.router.location.search
});

ReactDOM.render(
    <MainMenu/>,
    document.getElementsByTagName("header")[0]
);


export default connect(mapStateToProps)(MainMenu);
