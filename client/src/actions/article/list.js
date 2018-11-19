import fetch from '../../utils/fetch';

export function error(error) {
  return {type: 'ARTICLE_LIST_ERROR', error};
}

export function loading(loading) {
  return {type: 'ARTICLE_LIST_LOADING', loading};
}

export function success(data) {
  return {type: 'ARTICLE_LIST_SUCCESS', data};
}

// Les requêtes sont effectuées sur l'URL /articles
export function list(page = '/articles') {
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
  return {type: 'ARTICLE_LIST_RESET'};
}
