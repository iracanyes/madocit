import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/contribution/';

export default [
  <Route path='/contributions/create' component={Create} exact={true} key='create'/>,
  <Route path='/contributions/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/contributions/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/contributions/:page?' component={List} strict={true} key='list'/>,
];
