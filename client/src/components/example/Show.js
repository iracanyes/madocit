import React, {Component} from 'react';
import {connect} from 'react-redux';
import {Link, Redirect} from 'react-router-dom';
import PropTypes from 'prop-types';
import {retrieve, reset} from '../../actions/example/show';
import { del, loading, error } from '../../actions/example/delete';

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
              <th scope="row">content</th>
              <td>{item['content']}</td>
            </tr>
            <tr>
              <th scope="row">rating</th>
              <td>{item['rating']}</td>
            </tr>
            <tr>
              <th scope="row">dateCreated</th>
              <td>{item['dateCreated']}</td>
            </tr>
            <tr>
              <th scope="row">dateModified</th>
              <td>{item['dateModified']}</td>
            </tr>
            <tr>
              <th scope="row">pdf</th>
              <td>{item['pdf']}</td>
            </tr>
            <tr>
              <th scope="row">associatedArticles</th>
              <td>{item['associatedArticles']}</td>
            </tr>
            <tr>
              <th scope="row">associatedGrains</th>
              <td>{item['associatedGrains']}</td>
            </tr>
            <tr>
              <th scope="row">video</th>
              <td>{item['video']}</td>
            </tr>
          </tbody>
        </table>
      }
      <Link to=".." className="btn btn-primary">Back to list</Link>
      {item && <Link to={`/examples/edit/${encodeURIComponent(item['@id'])}`}>
        <button className="btn btn-warning">Edit</button>
        </Link>
      }
      <button onClick={this.del} className="btn btn-danger">Delete</button>
    </div>;
  }
}

const mapStateToProps = (state) => {
  return {
    error: state.example.show.error,
    loading: state.example.show.loading,
    retrieved:state.example.show.retrieved,
    deleteError: state.example.del.error,
    deleteLoading: state.example.del.loading,
    deleted: state.example.del.deleted,
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