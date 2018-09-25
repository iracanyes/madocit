import React from 'react';
import {Route} from 'react-router-dom';
import {List,Create, Update, Show} from '../components/subject/';

export default [
  <Route path='/subjects/create' component={Create} exact={true} key='create'/>,
  <Route path='/subjects/edit/:id' component={Update} exact={true} key='update'/>,
  <Route path='/subjects/show/:id' component={Show} exact={true} key='show'/>,
  <Route path='/subjects/:page?' component={List} strict={true} key='list'/>,
];
