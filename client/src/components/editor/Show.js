import React, {Component} from 'react';
import {connect} from 'react-redux';
import {Link, Redirect} from 'react-router-dom';
import PropTypes from 'prop-types';
import {retrieve, reset} from '../../actions/editor/show';
import { del, loading, error } from '../../actions/editor/delete';

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
              <th scope="row">emailContact</th>
              <td>{item['emailContact']}</td>
            </tr>
            <tr>
              <th scope="row">nickname</th>
              <td>{item['nickname']}</td>
            </tr>
            <tr>
              <th scope="row">familyName</th>
              <td>{item['familyName']}</td>
            </tr>
            <tr>
              <th scope="row">givenName</th>
              <td>{item['givenName']}</td>
            </tr>
            <tr>
              <th scope="row">affiliation</th>
              <td>{item['affiliation']}</td>
            </tr>
            <tr>
              <th scope="row">alumniOf</th>
              <td>{item['alumniOf']}</td>
            </tr>
            <tr>
              <th scope="row">rateGlobal</th>
              <td>{item['rateGlobal']}</td>
            </tr>
            <tr>
              <th scope="row">rateContribution</th>
              <td>{item['rateContribution']}</td>
            </tr>
            <tr>
              <th scope="row">sanctioned</th>
              <td>{item['sanctioned']}</td>
            </tr>
            <tr>
              <th scope="row">chatroomsCreated</th>
              <td>{item['chatroomsCreated']}</td>
            </tr>
            <tr>
              <th scope="row">chatroomsInvolved</th>
              <td>{item['chatroomsInvolved']}</td>
            </tr>
            <tr>
              <th scope="row">subjectsCreated</th>
              <td>{item['subjectsCreated']}</td>
            </tr>
            <tr>
              <th scope="row">notesSuggested</th>
              <td>{item['notesSuggested']}</td>
            </tr>
            <tr>
              <th scope="row">contributionsMade</th>
              <td>{item['contributionsMade']}</td>
            </tr>
            <tr>
              <th scope="row">abusesIdentified</th>
              <td>{item['abusesIdentified']}</td>
            </tr>
            <tr>
              <th scope="row">abusesAccused</th>
              <td>{item['abusesAccused']}</td>
            </tr>
            <tr>
              <th scope="row">sanctionsReceived</th>
              <td>{item['sanctionsReceived']}</td>
            </tr>
            <tr>
              <th scope="row">email</th>
              <td>{item['email']}</td>
            </tr>
            <tr>
              <th scope="row">password</th>
              <td>{item['password']}</td>
            </tr>
            <tr>
              <th scope="row">plainPassword</th>
              <td>{item['plainPassword']}</td>
            </tr>
            <tr>
              <th scope="row">userType</th>
              <td>{item['userType']}</td>
            </tr>
            <tr>
              <th scope="row">nbErrorConnection</th>
              <td>{item['nbErrorConnection']}</td>
            </tr>
            <tr>
              <th scope="row">banned</th>
              <td>{item['banned']}</td>
            </tr>
            <tr>
              <th scope="row">signinConfirmed</th>
              <td>{item['signinConfirmed']}</td>
            </tr>
            <tr>
              <th scope="row">dateRegistration</th>
              <td>{item['dateRegistration']}</td>
            </tr>
            <tr>
              <th scope="row">apiToken</th>
              <td>{item['apiToken']}</td>
            </tr>
            <tr>
              <th scope="row">image</th>
              <td>{item['image']}</td>
            </tr>
          </tbody>
        </table>
      }
      <Link to=".." className="btn btn-primary">Back to list</Link>
      {item && <Link to={`/editors/edit/${encodeURIComponent(item['@id'])}`}>
        <button className="btn btn-warning">Edit</button>
        </Link>
      }
      <button onClick={this.del} className="btn btn-danger">Delete</button>
    </div>;
  }
}

const mapStateToProps = (state) => {
  return {
    error: state.editor.show.error,
    loading: state.editor.show.loading,
    retrieved:state.editor.show.retrieved,
    deleteError: state.editor.del.error,
    deleteLoading: state.editor.del.loading,
    deleted: state.editor.del.deleted,
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
