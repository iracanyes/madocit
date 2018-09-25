import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/grain/';

export default [
  <Route path='/grains/create' component={Create} exact={true} key='create'/>,
  <Route path='/grains/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/grains/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/grains/:page?' component={List} strict={true} key='list'/>,
];
