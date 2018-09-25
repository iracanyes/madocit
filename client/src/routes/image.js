import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/image/';

export default [
  <Route path='/images/create' component={Create} exact={true} key='create'/>,
  <Route path='/images/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/images/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/images/:page?' component={List} strict={true} key='list'/>,
];
