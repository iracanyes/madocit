/**
 * Author: iracanyes
 * Date: 12/7/18
 * Description: Sidebar Menu
 */
import React, { Component, Fragment } from 'react';
import { push } from 'connected-react-router';

export default class AsideMenu extends Component
{
    render()
    {
        return <Fragment>
            <div className="menu">
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
            </div>
        </Fragment>
    }
}
