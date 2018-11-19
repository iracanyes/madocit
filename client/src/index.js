import React from 'react';
import ReactDom from 'react-dom';
import { createStore, combineReducers, applyMiddleware, compose } from 'redux';
import { Provider } from 'react-redux';
import thunk from 'redux-thunk';
import { reducer as form } from 'redux-form';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import createBrowserHistory from 'history/createBrowserHistory';
import { syncHistoryWithStore, routerReducer as routing } from 'react-router-redux';
import 'bootstrap/dist/css/bootstrap.css';
import 'font-awesome/css/font-awesome.css';
import registerServiceWorker from './registerServiceWorker';

// Import your reducers and routes here
import Welcome from './Welcome';

// Import reducers and routes of the application
// import reducers for articles
import article from './reducers/article/';

//import routes for articles
import articleRoutes from './routes/article';

// import reducers for categories
import category from './reducers/category/';

//import routes for categories
import categoryRoutes from './routes/category';

// import reducers for editors
import editor from './reducers/editor/';

//import routes for editors
import editorRoutes from './routes/editor';

// import reducers for videos
import video from './reducers/video/';

//import routes for videos
import videoRoutes from './routes/video';

// import reducers for notes
import note from './reducers/note/';

//import routes for notes
import noteRoutes from './routes/note';

// import reducers
import message from './reducers/message/';

//import routes
import messageRoutes from './routes/message';


// import reducers for images
import image from './reducers/image/';

//import routes for images
import imageRoutes from './routes/image';

// import reducers for subject
import subject from './reducers/subject/';

//import routes for subjects
import subjectRoutes from './routes/subject';

// import reducers for chatrooms
import chat from './reducers/chat/';

//import routes for chatrooms
import chatRoutes from './routes/chat';

// import reducers for versions
import version from './reducers/version/';

//import routes for versions
import versionRoutes from './routes/version';

// import reducers for examples
import example from './reducers/example/';

//import routes for examples
import exampleRoutes from './routes/example';

// import reducers for grains
import grain from './reducers/grain/';

//import routes for grains
import grainRoutes from './routes/grain';

// import reducers for contributions
import contribution from './reducers/contribution/';

//import routes for contributions
import contributionRoutes from './routes/contribution';

// import reducers for abuses
import abuse from './reducers/abuse/';

//import routes for abuses
import abuseRoutes from './routes/abuse';

// import reducers for themes
import theme from './reducers/theme/';

//import routes for themes
import themeRoutes from './routes/theme';

/* redux dev tools : https://github.com/zalmoxisus/redux-devtools-extension#usage*/
const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;


/*
const store = createStore(
  combineReducers(
    {
    routing,
    form,
    },
    // Add your reducers here
    combineReducers(abuse,{ }),
    combineReducers(article,{}),
    combineReducers(category,{}),
    combineReducers(chat,{}),
    combineReducers(contribution,{}),
    combineReducers(editor,{}),
    combineReducers(example,{}),
    combineReducers(grain,{}),
    combineReducers(image,{}),
    combineReducers(note,{}),
    combineReducers(subject,{}),
    combineReducers(theme,{}),
    combineReducers(version,{}),
    combineReducers(video,{}),),
    // Add the reducer
    combineReducers(message,{}),

    applyMiddleware(thunk),
  );
*/
const store = createStore(
    combineReducers(
        {
            routing,
            form,
            abuse,
            article,
            category,
            chat,
            contribution,
            editor,
            example,
            grain,
            image,
            message,
            note,
            subject,
            theme,
            version,
            video

        }
    ),
    composeEnhancers(
        applyMiddleware(thunk)
    )

);

const history = syncHistoryWithStore(createBrowserHistory(), store);

ReactDom.render(
  <Provider store={store}>
    <Router history={history}>
      <Switch>
        <Route path="/" component={Welcome} strict={true} exact={true}/>
        { /* Add your routes here */  },
        { abuseRoutes },
        { articleRoutes },
        { categoryRoutes },
        { chatRoutes },
        { contributionRoutes },
        { editorRoutes },
        { exampleRoutes },
        { grainRoutes },
        { imageRoutes },
        { noteRoutes },
        { subjectRoutes },
        { themeRoutes },
        { versionRoutes },
        { videoRoutes },
          { messageRoutes }
        <Route render={() => <h1>Not Found</h1>}/>
      </Switch>
    </Router>
  </Provider>,
  document.getElementById('root')
);

registerServiceWorker();
