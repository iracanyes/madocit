import fetch from '../../utils/fetch';

export function error(error) {
  return {type: 'GRAIN_LIST_ERROR', error};
}

export function loading(loading) {
  return {type: 'GRAIN_LIST_LOADING', loading};
}

export function success(data) {
  return {type: 'GRAIN_LIST_SUCCESS', data};
}

export function list(page = '/grains') {
  return (dispatch) => {
    dispatch(loading(true));
    dispatch(error(''));

    fetch(page)
      .then(response => response.json())
      .then(data => {
        dispatch(loading(false));
        dispatch(success(data));
        console.log(data);
      })
      .catch(e => {
        dispatch(loading(false));
        dispatch(error(e.message))
      });
  };
}

export function reset() {
  return {type: 'GRAIN_LIST_RESET'};
}
