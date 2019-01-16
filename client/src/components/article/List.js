import React, {Component} from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';
import { list, reset } from '../../actions/article/list';
import { success } from '../../actions/article/delete';
import { itemToLinks } from '../../utils/helpers';

class List extends Component {
  static propTypes = {
    error: PropTypes.string,
    loading: PropTypes.bool.isRequired,
    data: PropTypes.object.isRequired,
    deletedItem: PropTypes.object,
    list: PropTypes.func.isRequired,
    reset: PropTypes.func.isRequired,
  };

  componentDidMount() {
    if(!this.props.loading){
      this.props.list(this.props.match.params.page && decodeURIComponent(this.props.match.params.page));
    }

  }

  componentWillReceiveProps(nextProps) {
    if (this.props.match.params.page !== nextProps.match.params.page) nextProps.list(nextProps.match.params.page && decodeURIComponent(nextProps.match.params.page));
  }

  componentWillUnmount() {
    this.props.reset();
  }

  render() {
    return <div className={"article-list-page"}>
      <h1>Documentation : Articles</h1>

      {this.props.loading && <div className="alert alert-info">Loading...</div>}
      {this.props.deletedItem && <div className="alert alert-success">{this.props.deletedItem['@id']} deleted.</div>}
      {this.props.error && <div className="alert alert-danger">{this.props.error}</div>}

      <section className="carousel3-articles col-lg-12">
        <div className="card-deck">
          {this.props.data["hydra:member"] && this.props.data["hydra:member"][0].map(item =>

            <div className="card">
              <img className="card-img-top" src={item[0]["images"][0]["url"]} alt="Card image cap"/>
              <div className="card-body">
                <h5 className="card-title">{item[0]["title"]}</h5>
                <p className="card-text">{item[0]['description']}</p>
              </div>
              <div className="card-footer">
                <small className="text-muted">{new Date(item[0]['dateModified']).toLocaleDateString('fr-BE')}</small>
                <small className={"text-muted float-right"}>Par {item['nickname']}</small>
              </div>
            </div>
          )}
        </div>
        {this.pagination()}
        {/*
        <ul className="pagination">
          <li className="page-item"><a className="page-link" href="#">Précédent</a></li>
          <li className="page-item"><a className="page-link" href="#">1</a></li>
          <li className="page-item active"><a className="page-link" href="#">2</a></li>
          <li className="page-item"><a className="page-link" href="#">3</a></li>
          <li className="page-item"><a className="page-link" href="#">Suivant</a></li>
        </ul>
        */}
      </section>





      {/*

        <table className="table table-responsive table-striped table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>articleBody</th>
            <th>dateCreated</th>
            <th>dateModified</th>
            <th>datePublished</th>
            <th>coursePrerequisites</th>
            <th>aggregateRating</th>
            <th>pdf</th>
            <th>about</th>
            <th>associatedExamples</th>
            <th>video</th>
            <th colSpan={2}></th>
          </tr>
        </thead>
        <tbody>
        {this.props.data['hydra:member'] && this.props.data['hydra:member'][0].map(item =>
          <tr key={item['@id']}>
            <th scope="row"><Link to={`show/${encodeURIComponent(item['@id'])}`}>{item['@id']}</Link></th>
            <td>{item['articleBody'] ? itemToLinks(item['articleBody']) : ''}</td>
            <td>{item['dateCreated'] ? itemToLinks(item['dateCreated']) : ''}</td>
            <td>{item['dateModified'] ? itemToLinks(item['dateModified']) : ''}</td>
            <td>{item['datePublished'] ? itemToLinks(item['datePublished']) : ''}</td>
            <td>{item['coursePrerequisites'] ? itemToLinks(item['coursePrerequisites']) : ''}</td>
            <td>{item['aggregateRating'] ? itemToLinks(item['aggregateRating']) : ''}</td>
            <td>{item['pdf'] ? itemToLinks(item['pdf']) : ''}</td>
            <td>{item['about'] ? itemToLinks(item['about']) : ''}</td>
            <td>{item['associatedExamples'] ? itemToLinks(item['associatedExamples']) : ''}</td>
            <td>{item['video'] ? itemToLinks(item['video']) : ''}</td>
            <td>
              <Link to={`show/${encodeURIComponent(item['@id'])}`}>
                <span className="fa fa-search" aria-hidden="true"/>
                <span className="sr-only">Show</span>
              </Link>
            </td>
            <td>
              <Link to={`edit/${encodeURIComponent(item['@id'])}`}>
                <span className="fa fa-pencil" aria-hidden="true"/>
                <span className="sr-only">Edit</span>
              </Link>
            </td>
          </tr>
        )}
        </tbody>
      </table>

      {this.pagination()}
      */}
    </div>;
  }

  pagination() {
    const view = this.props.data['hydra:view'];
    if (!view) return;

    const {'hydra:first': first, 'hydra:previous': previous,'hydra:next': next, 'hydra:last': last} = view;

    return <nav aria-label="Page navigation">
      <ul className="pagination">
        <Link to='.' className={`btn btn-primary${previous ? '' : ' disabled'}`}><span aria-hidden="true">&lArr;</span> First</Link>
        <Link to={!previous || previous === first ? '.' : encodeURIComponent(previous)} className={`btn btn-primary${previous ? '' : ' disabled'}`}><span aria-hidden="true">&larr;</span> Previous</Link>
        <Link to={next ? encodeURIComponent(next) : '#'} className={`btn btn-primary${next ? '' : ' disabled'}`}>Next <span aria-hidden="true">&rarr;</span></Link>
        <Link to={last ? encodeURIComponent(last) : '#'} className={`btn btn-primary${next ? '' : ' disabled'}`}>Last <span aria-hidden="true">&rArr;</span></Link>
      </ul>

    </nav>;
  }
}

const mapStateToProps = (state) => {
  return {
    data: state.article.list.data,
    error: state.article.list.error,
    loading: state.article.list.loading,
    deletedItem: state.article.del.deleted,
  };
};

const mapDispatchToProps = (dispatch) => {
  return {
    list: (page) => dispatch(list(page)),
    reset: () => {
      dispatch(reset());
      dispatch(success(null));
    },
  };
};

export default connect(mapStateToProps, mapDispatchToProps)(List);
