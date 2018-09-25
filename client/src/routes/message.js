import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/message/';

export default [
  <Route path='/messages/create' component={Create} exact={true} key='create'/>,
  <Route path='/messages/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/messages/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/messages/:page?' component={List} strict={true} key='list'/>,
];
