import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/theme/';

export default [
  <Route path='/themes/create' component={Create} exact={true} key='create'/>,
  <Route path='/themes/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/themes/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/themes/:page?' component={List} strict={true} key='list'/>,
];
