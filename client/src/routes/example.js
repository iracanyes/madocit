import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/example/';

export default [
  <Route path='/examples/create' component={Create} exact={true} key='create'/>,
  <Route path='/examples/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/examples/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/examples/:page?' component={List} strict={true} key='list'/>,
];
