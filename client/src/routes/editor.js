import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/editor/';

export default [
  <Route path='/editors/create' component={Create} exact={true} key='create'/>,
  <Route path='/editors/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/editors/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/editors/:page?' component={List} strict={true} key='list'/>,
];
