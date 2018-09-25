import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/editorschats/';

export default [
  <Route path='/editors_chats/create' component={Create} exact={true} key='create'/>,
  <Route path='/editors_chats/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/editors_chats/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/editors_chats/:page?' component={List} strict={true} key='list'/>,
];
