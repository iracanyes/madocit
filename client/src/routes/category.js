import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/category/';

export default [
  <Route path='/categories/create' component={Create} exact={true} key='create'/>,
  <Route path='/categories/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/categories/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/categories/:page?' component={List} strict={true} key='list'/>,
];
