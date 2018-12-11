/**
 * Author: iracanyes
 * Date: 12/7/18
 * Description: Sidebar Menu
 */
import React, { Component, Fragment } from 'react';
import { push } from 'connected-react-router';
import {
    Nav,
    NavItem,
    NavLink,
    Collapse,
    UncontrolledDropdown,
    DropdownMenu,
    DropdownToggle,
    DropdownItem
} from 'reactstrap';

export default class SidebarLeftMenu extends Component
{
    render()
    {

        return <Fragment>
            <div className="menu">
                <Nav vertical>
                    <UncontrolledDropdown nav inNavbar>
                        <DropdownToggle nav caret outline>
                            <span style={{fontSize: "14px", color: "Dodgerblue"}}>
                              <i className="fas fa-user-circle"></i>
                            </span>
                            Profile
                        </DropdownToggle>
                        <DropdownMenu bottom outline>
                            <DropdownItem >
                                <span style={{fontSize: "14px", color: "Dodgerblue"}}>
                                  <i className="fas fa-sign-in-alt"></i>
                                </span>
                                Login
                            </DropdownItem>
                            <DropdownItem>
                                <span style={{fontSize: "14px", color: "Dodgerblue"}}>
                                  <i className="fas fa-sign-in-alt"></i>
                                </span>
                                Sign/out
                            </DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>
                                <span style={{fontSize: "14px", color: "Dodgerblue"}}>
                                  <i className="fas fa-id-card"></i>
                                </span>
                                Activité
                            </DropdownItem>
                            <DropdownItem>

                            </DropdownItem>
                        </DropdownMenu>
                    </UncontrolledDropdown>
                    <UncontrolledDropdown nav inNavbar>
                        <DropdownToggle nav caret outline>
                            <span style={{fontSize: "14px", color: "Dodgerblue"}}>
                              <i className="fas fa-edit"></i>
                            </span>
                            Documentation
                        </DropdownToggle>
                        <DropdownMenu bottom>
                            <UncontrolledDropdown nav inNavbar>
                                <DropdownToggle nav caret outline>
                                    Profile
                                </DropdownToggle>
                                <DropdownMenu right outline>
                                    <DropdownItem>
                                        Login
                                    </DropdownItem>
                                    <DropdownItem>
                                        Sign/out
                                    </DropdownItem>
                                    <DropdownItem divider/>
                                    <DropdownItem>
                                        Activité
                                    </DropdownItem>
                                    <DropdownItem>

                                    </DropdownItem>
                                </DropdownMenu>
                            </UncontrolledDropdown>
                            <DropdownItem>
                                <NavLink href={"#"} outline>Créer</NavLink>
                            </DropdownItem>
                            <DropdownItem>
                                <NavLink href={"#"} outline>Mettre à jour</NavLink>
                            </DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>
                                <NavLink href={"#"} outline>Vos publications</NavLink>
                            </DropdownItem>
                            <DropdownItem>
                                <NavLink href={"#"} outline>Supprimer</NavLink>
                            </DropdownItem>
                        </DropdownMenu>
                    </UncontrolledDropdown>
                </Nav>
                {/*
                <ul className="nav flex-column">
                    <li className="nav-item">
                        <a className="nav-link active" href="documentation.html"><i className="fa fa-fw fa-home"></i>Documentation</a>
                    </li>
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="subNavbarDropdownCategory" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i className="fas fa-boxes"></i>Catégories
                        </a>
                        <div className="dropdown-menu" aria-labelledby="subNavbarDropdownCategory">
                            <a className="dropdown-item" href="#">Action</a>
                            <a className="dropdown-item" href="#">Another action</a>
                            <a className="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="subNavbarDropdownTheme" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Thèmes
                        </a>
                        <div className="dropdown-menu" aria-labelledby="subNavbarDropdownTheme">
                            <a className="dropdown-item" href="#">Action</a>
                            <a className="dropdown-item" href="#">Another action</a>
                            <a className="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="#">Link</a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link disabled" href="#">Disabled</a>
                    </li>
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="subNavbarDropdownSubCategory" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Catégories
                        </a>
                        <div className="dropdown-menu" aria-labelledby="subNavbarDropdownSubCategory">
                            <a className="dropdown-item" href="#">Action</a>
                            <a className="dropdown-item" href="#">Another action</a>
                            <a className="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
                */}
            </div>
        </Fragment>
    }
}
