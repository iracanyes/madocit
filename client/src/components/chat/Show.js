import React, {Component} from 'react';
import {connect} from 'react-redux';
import {Link, Redirect} from 'react-router-dom';
import PropTypes from 'prop-types';
import {retrieve, reset} from '../../actions/chat/show';
import { del, loading, error } from '../../actions/chat/delete';

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
              <th scope="row">status</th>
              <td>{item['status']}</td>
            </tr>
            <tr>
              <th scope="row">closed</th>
              <td>{item['closed']}</td>
            </tr>
            <tr>
              <th scope="row">downvoteCount</th>
              <td>{item['downvoteCount']}</td>
            </tr>
            <tr>
              <th scope="row">upvoteCount</th>
              <td>{item['upvoteCount']}</td>
            </tr>
            <tr>
              <th scope="row">aggregateRating</th>
              <td>{item['aggregateRating']}</td>
            </tr>
            <tr>
              <th scope="row">creator</th>
              <td>{item['creator']}</td>
            </tr>
            <tr>
              <th scope="row">subjects</th>
              <td>{item['subjects']}</td>
            </tr>
            <tr>
              <th scope="row">editorsInvolved</th>
              <td>{item['editorsInvolved']}</td>
            </tr>
            <tr>
              <th scope="row">abuses</th>
              <td>{item['abuses']}</td>
            </tr>
          </tbody>
        </table>
      }
      <Link to=".." className="btn btn-primary">Back to list</Link>
      {item && <Link to={`/chats/edit/${encodeURIComponent(item['@id'])}`}>
        <button className="btn btn-warning">Edit</button>
        </Link>
      }
      <button onClick={this.del} className="btn btn-danger">Delete</button>
    </div>;
  }
}

const mapStateToProps = (state) => {
  return {
    error: state.chat.show.error,
    loading: state.chat.show.loading,
    retrieved:state.chat.show.retrieved,
    deleteError: state.chat.del.error,
    deleteLoading: state.chat.del.loading,
    deleted: state.chat.del.deleted,
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
