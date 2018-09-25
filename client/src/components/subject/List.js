import React, {Component} from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';
import { list, reset } from '../../actions/subject/list';
import { success } from '../../actions/subject/delete';
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
    this.props.list(this.props.match.params.page && decodeURIComponent(this.props.match.params.page));
  }

  componentWillReceiveProps(nextProps) {
    if (this.props.match.params.page !== nextProps.match.params.page) nextProps.list(nextProps.match.params.page && decodeURIComponent(nextProps.match.params.page));
  }

  componentWillUnmount() {
    this.props.reset();
  }

  render() {
    return <div>
      <h1>Subject List</h1>

      {this.props.loading && <div className="alert alert-info">Loading...</div>}
      {this.props.deletedItem && <div className="alert alert-success">{this.props.deletedItem['@id']} deleted.</div>}
      {this.props.error && <div className="alert alert-danger">{this.props.error}</div>}

      <p><Link to="create" className="btn btn-primary">Create</Link></p>

        <table className="table table-responsive table-striped table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>title</th>
            <th>description</th>
            <th>dependencies</th>
            <th>proficiencyLevel</th>
            <th>isValid</th>
            <th>article</th>
            <th>grain</th>
            <th>author</th>
            <th>hasPart</th>
            <th>isPartOf</th>
            <th>notes</th>
            <th>contributionsSuggested</th>
            <th>chatrooms</th>
            <th>version</th>
            <th>images</th>
            <th colSpan={2}></th>
          </tr>
        </thead>
        <tbody>
        {this.props.data['hydra:member'] && this.props.data['hydra:member'].map(item =>
          <tr key={item['@id']}>
            <th scope="row"><Link to={`show/${encodeURIComponent(item['@id'])}`}>{item['@id']}</Link></th>
            <td>{item['title'] ? itemToLinks(item['title']) : ''}</td>
            <td>{item['description'] ? itemToLinks(item['description']) : ''}</td>
            <td>{item['dependencies'] ? itemToLinks(item['dependencies']) : ''}</td>
            <td>{item['proficiencyLevel'] ? itemToLinks(item['proficiencyLevel']) : ''}</td>
            <td>{item['isValid'] ? itemToLinks(item['isValid']) : ''}</td>
            <td>{item['article'] ? itemToLinks(item['article']) : ''}</td>
            <td>{item['grain'] ? itemToLinks(item['grain']) : ''}</td>
            <td>{item['author'] ? itemToLinks(item['author']) : ''}</td>
            <td>{item['hasPart'] ? itemToLinks(item['hasPart']) : ''}</td>
            <td>{item['isPartOf'] ? itemToLinks(item['isPartOf']) : ''}</td>
            <td>{item['notes'] ? itemToLinks(item['notes']) : ''}</td>
            <td>{item['contributionsSuggested'] ? itemToLinks(item['contributionsSuggested']) : ''}</td>
            <td>{item['chatrooms'] ? itemToLinks(item['chatrooms']) : ''}</td>
            <td>{item['version'] ? itemToLinks(item['version']) : ''}</td>
            <td>{item['images'] ? itemToLinks(item['images']) : ''}</td>
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
    </div>;
  }

  pagination() {
    const view = this.props.data['hydra:view'];
    if (!view) return;

    const {'hydra:first': first, 'hydra:previous': previous,'hydra:next': next, 'hydra:last': last} = view;

    return <nav aria-label="Page navigation">
        <Link to='.' className={`btn btn-primary${previous ? '' : ' disabled'}`}><span aria-hidden="true">&lArr;</span> First</Link>
        <Link to={!previous || previous === first ? '.' : encodeURIComponent(previous)} className={`btn btn-primary${previous ? '' : ' disabled'}`}><span aria-hidden="true">&larr;</span> Previous</Link>
        <Link to={next ? encodeURIComponent(next) : '#'} className={`btn btn-primary${next ? '' : ' disabled'}`}>Next <span aria-hidden="true">&rarr;</span></Link>
        <Link to={last ? encodeURIComponent(last) : '#'} className={`btn btn-primary${next ? '' : ' disabled'}`}>Last <span aria-hidden="true">&rArr;</span></Link>
    </nav>;
  }
}

const mapStateToProps = (state) => {
  return {
    data: state.subject.list.data,
    error: state.subject.list.error,
    loading: state.subject.list.loading,
    deletedItem: state.subject.del.deleted,
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
