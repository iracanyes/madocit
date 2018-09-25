import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/abuse/';

export default [
  <Route path='/abuses/create' component={Create} exact={true} key='create'/>,
  <Route path='/abuses/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/abuses/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/abuses/:page?' component={List} strict={true} key='list'/>,
];
