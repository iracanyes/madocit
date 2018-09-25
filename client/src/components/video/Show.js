import React, {Component} from 'react';
import {connect} from 'react-redux';
import {Link, Redirect} from 'react-router-dom';
import PropTypes from 'prop-types';
import {retrieve, reset} from '../../actions/video/show';
import { del, loading, error } from '../../actions/video/delete';

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
              <th scope="row">caption</th>
              <td>{item['caption']}</td>
            </tr>
            <tr>
              <th scope="row">url</th>
              <td>{item['url']}</td>
            </tr>
            <tr>
              <th scope="row">embedUrl</th>
              <td>{item['embedUrl']}</td>
            </tr>
            <tr>
              <th scope="row">size</th>
              <td>{item['size']}</td>
            </tr>
            <tr>
              <th scope="row">uploadDate</th>
              <td>{item['uploadDate']}</td>
            </tr>
            <tr>
              <th scope="row">thumbnail</th>
              <td>{item['thumbnail']}</td>
            </tr>
            <tr>
              <th scope="row">associatedArticle</th>
              <td>{item['associatedArticle']}</td>
            </tr>
            <tr>
              <th scope="row">associatedExample</th>
              <td>{item['associatedExample']}</td>
            </tr>
            <tr>
              <th scope="row">associatedGrain</th>
              <td>{item['associatedGrain']}</td>
            </tr>
          </tbody>
        </table>
      }
      <Link to=".." className="btn btn-primary">Back to list</Link>
      {item && <Link to={`/videos/edit/${encodeURIComponent(item['@id'])}`}>
        <button className="btn btn-warning">Edit</button>
        </Link>
      }
      <button onClick={this.del} className="btn btn-danger">Delete</button>
    </div>;
  }
}

const mapStateToProps = (state) => {
  return {
    error: state.video.show.error,
    loading: state.video.show.loading,
    retrieved:state.video.show.retrieved,
    deleteError: state.video.del.error,
    deleteLoading: state.video.del.loading,
    deleted: state.video.del.deleted,
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
