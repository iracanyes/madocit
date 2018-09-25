import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/chat/';

export default [
  <Route path='/chats/create' component={Create} exact={true} key='create'/>,
  <Route path='/chats/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/chats/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/chats/:page?' component={List} strict={true} key='list'/>,
];
