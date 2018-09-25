import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/version/';

export default [
  <Route path='/versions/create' component={Create} exact={true} key='create'/>,
  <Route path='/versions/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/versions/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/versions/:page?' component={List} strict={true} key='list'/>,
];
