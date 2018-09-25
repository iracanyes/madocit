import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/article/';

export default [
  <Route path='/articles/create' component={Create} exact={true} key='create'/>,
  <Route path='/articles/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/articles/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/articles/:page?' component={List} strict={true} key='list'/>,
];
