import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/group/';

export default [
  <Route path='/groups/create' component={Create} exact={true} key='create'/>,
  <Route path='/groups/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/groups/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/groups/:page?' component={List} strict={true} key='list'/>,
];
