import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/privilege/';

export default [
  <Route path='/privileges/create' component={Create} exact={true} key='create'/>,
  <Route path='/privileges/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/privileges/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/privileges/:page?' component={List} strict={true} key='list'/>,
];
