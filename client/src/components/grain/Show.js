import React, {Component} from 'react';
import {connect} from 'react-redux';
import {Link, Redirect} from 'react-router-dom';
import PropTypes from 'prop-types';
import {retrieve, reset} from '../../actions/grain/show';
import { del, loading, error } from '../../actions/grain/delete';

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
              <th scope="row">content</th>
              <td>{item['content']}</td>
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
              <th scope="row">datePublished</th>
              <td>{item['datePublished']}</td>
            </tr>
            <tr>
              <th scope="row">draft</th>
              <td>{item['draft']}</td>
            </tr>
            <tr>
              <th scope="row">rating</th>
              <td>{item['rating']}</td>
            </tr>
            <tr>
              <th scope="row">about</th>
              <td>{item['about']}</td>
            </tr>
            <tr>
              <th scope="row">associatedExamples</th>
              <td>{item['associatedExamples']}</td>
            </tr>
            <tr>
              <th scope="row">video</th>
              <td>{item['video']}</td>
            </tr>
          </tbody>
        </table>
      }
      <Link to=".." className="btn btn-primary">Back to list</Link>
      {item && <Link to={`/grains/edit/${encodeURIComponent(item['@id'])}`}>
        <button className="btn btn-warning">Edit</button>
        </Link>
      }
      <button onClick={this.del} className="btn btn-danger">Delete</button>
    </div>;
  }
}

const mapStateToProps = (state) => {
  return {
    error: state.grain.show.error,
    loading: state.grain.show.loading,
    retrieved:state.grain.show.retrieved,
    deleteError: state.grain.del.error,
    deleteLoading: state.grain.del.loading,
    deleted: state.grain.del.deleted,
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
