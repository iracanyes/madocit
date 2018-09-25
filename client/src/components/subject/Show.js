import React, {Component} from 'react';
import {connect} from 'react-redux';
import {Link, Redirect} from 'react-router-dom';
import PropTypes from 'prop-types';
import {retrieve, reset} from '../../actions/subject/show';
import { del, loading, error } from '../../actions/subject/delete';

class Show extends Component {
  static propTypes = {
    error: PropTypes.string,
    loading: PropTypes.bool.isRequired,
    retrieved: PropTypes.object,
    retrieve: PropTypes.func.isRequired,
    reset: PropTypes.func.isRequired,
    deleteError: PropTypes.string,
    deleteLoading: PropTypes.bool.isRequired,
    deleted: PropTypes.object,
    del: PropTypes.func.isRequired
  };

  componentDidMount() {
    this.props.retrieve(decodeURIComponent(this.props.match.params.id));
  }

  componentWillUnmount() {
    this.props.reset();
  }

  del = () => {
    if (window.confirm('Are you sure you want to delete this item?')) this.props.del(this.props.retrieved);
  };

  render() {
    if (this.props.deleted) return <Redirect to=".."/>;

    const item = this.props.retrieved;

    return <div>
      <h1>Show {item && item['@id']}</h1>

      {this.props.loading && <div className="alert alert-info" role="status">Loading...</div>}
      {this.props.error && <div className="alert alert-danger" role="alert"><span className="fa fa-exclamation-triangle" aria-hidden="true"></span> {this.props.error}</div>}
      {this.props.deleteError && <div className="alert alert-danger" role="alert"><span className="fa fa-exclamation-triangle" aria-hidden="true"></span> {this.props.deleteError}</div>}

      {item && <table className="table table-responsive table-striped table-hover">
          <thead>
            <tr>
              <th>Field</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">title</th>
              <td>{item['title']}</td>
            </tr>
            <tr>
              <th scope="row">description</th>
              <td>{item['description']}</td>
            </tr>
            <tr>
              <th scope="row">dependencies</th>
              <td>{item['dependencies']}</td>
            </tr>
            <tr>
              <th scope="row">proficiencyLevel</th>
              <td>{item['proficiencyLevel']}</td>
            </tr>
            <tr>
              <th scope="row">isValid</th>
              <td>{item['isValid']}</td>
            </tr>
            <tr>
              <th scope="row">article</th>
              <td>{item['article']}</td>
            </tr>
            <tr>
              <th scope="row">grain</th>
              <td>{item['grain']}</td>
            </tr>
            <tr>
              <th scope="row">author</th>
              <td>{item['author']}</td>
            </tr>
            <tr>
              <th scope="row">hasPart</th>
              <td>{item['hasPart']}</td>
            </tr>
            <tr>
              <th scope="row">isPartOf</th>
              <td>{item['isPartOf']}</td>
            </tr>
            <tr>
              <th scope="row">notes</th>
              <td>{item['notes']}</td>
            </tr>
            <tr>
              <th scope="row">contributionsSuggested</th>
              <td>{item['contributionsSuggested']}</td>
            </tr>
            <tr>
              <th scope="row">chatrooms</th>
              <td>{item['chatrooms']}</td>
            </tr>
            <tr>
              <th scope="row">version</th>
              <td>{item['version']}</td>
            </tr>
            <tr>
              <th scope="row">images</th>
              <td>{item['images']}</td>
            </tr>
          </tbody>
        </table>
      }
      <Link to=".." className="btn btn-primary">Back to list</Link>
      {item && <Link to={`/subjects/edit/${encodeURIComponent(item['@id'])}`}>
        <button className="btn btn-warning">Edit</button>
        </Link>
      }
      <button onClick={this.del} className="btn btn-danger">Delete</button>
    </div>;
  }
}

const mapStateToProps = (state) => {
  return {
    error: state.subject.show.error,
    loading: state.subject.show.loading,
    retrieved:state.subject.show.retrieved,
    deleteError: state.subject.del.error,
    deleteLoading: state.subject.del.loading,
    deleted: state.subject.del.deleted,
  };
};

const mapDispatchToProps = (dispatch) => {
  return {
    retrieve: id => dispatch(retrieve(id)),
    del: item => dispatch(del(item)),
    reset: () => {
      dispatch(reset());
      dispatch(error(null));
      dispatch(loading(false));
    },
  }
};

export default connect(mapStateToProps, mapDispatchToProps)(Show);
