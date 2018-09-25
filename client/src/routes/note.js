import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/note/';

export default [
  <Route path='/notes/create' component={Create} exact={true} key='create'/>,
  <Route path='/notes/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/notes/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/notes/:page?' component={List} strict={true} key='list'/>,
];
