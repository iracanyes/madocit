/**
 * Author: iracanyes
 * Date: 11/19/18
 * Description:
 */
import React, {Component, Fragment} from "react";

export default class MainMenu extends Component
{

    render()
    {
        return <Fragment>
            <nav id="navbar-primary" className="navbar navbar-expand-lg navbar-dark bg-primary">
                {/* Navbar content */}
                <a className="navbar-brand col-lg-2" href="#">MaDocIT</a>
                <button className="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarMainDropdown" aria-controls="navbarMainDropdown" aria-expanded="false"
                        aria-label="Menu principal">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="col-lg-7 collapse navbar-collapse" id="navbarMainDropdown">
                    <ul className="navbar-nav">
                        <li className="nav-item active">
                            <a className="nav-link" href="index.html"><i className="fa fa-fw fa-home"></i>Accueil<span
                                className="sr-only">(current)</span></a>
                        </li>
                        <li className="nav-item dropdown">
                            <a className="nav-link dropdown-toggle" href="documentation.html"
                               id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i className="fas fa-layer-group"></i>Documentation
                            </a>
                            <div className="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                <a className="dropdown-item" href="listing.html">Listing</a>
                                <a className="dropdown-item" href="#">Thème</a>
                                <a className="dropdown-item" href="article.html">Article</a>
                            </div>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="chat.html"><i className="far fa-comments"></i>Chat</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="contact.html"><i className="fas fa-at"></i>Contact</a>
                        </li>
                        <li className="nav-item dropdown">
                            <a className="nav-link dropdown-toggle" href="documentation.html"
                               id="navbarDropdownMenuProfileMain" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i className="fas fa-user"></i>Membre
                            </a>
                            <div className="dropdown-menu" aria-labelledby="navbarDropdownMenuProfileMain">
                                <a className="dropdown-item" href="login.html">Connexion</a>
                                <a className="dropdown-item" href="profile.html">Profile</a>
                                <a className="dropdown-item" href="article.html">Déconnexion</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <form className="form-inline">
                    <input className="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search"/>
                        <button className="btn btn-outline-primary my-2 my-sm-0" type="submit"><i className="fa fa-search"></i></button>
                </form>
            </nav>
        </Fragment>
    }
}