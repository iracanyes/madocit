import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/video/';

export default [
  <Route path='/videos/create' component={Create} exact={true} key='create'/>,
  <Route path='/videos/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/videos/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/videos/:page?' component={List} strict={true} key='list'/>,
];
