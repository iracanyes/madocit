import { combineReducers } from 'redux'

export function error(state = null, action) {
  switch (action.type) {
    case 'EXAMPLE_SHOW_ERROR':
      return action.error;

    case 'EXAMPLE_SHOW_RESET':
      return null;

    default:
      return state;
  }
}

export function loading(state = false, action) {
  switch (action.type) {
    case 'EXAMPLE_SHOW_LOADING':
      return action.loading;

    case 'EXAMPLE_SHOW_RESET':
      return false;

    default:
      return state;
  }
}

export function retrieved(state = null, action) {
  switch (action.type) {
    case 'EXAMPLE_SHOW_RETRIEVED_SUCCESS':
      return action.retrieved;

    case 'EXAMPLE_SHOW_RESET':
      return null;

    default:
      return state;
  }
}

export default combineReducers({error, loading, retrieved});
