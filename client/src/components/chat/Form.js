import React, { Component } from 'react';
import { Field, reduxForm } from 'redux-form';

class Form extends Component {
  renderField = (data) => {
    data.input.className = 'form-control';

    const isInvalid = data.meta.touched && !!data.meta.error;
    if (isInvalid) {
      data.input.className += ' is-invalid';
      data.input['aria-invalid'] = true;
    }

    if (this.props.error && data.meta.touched && !data.meta.error) {
      data.input.className += ' is-valid';
    }

    return <div className={`form-group`}>
      <label htmlFor={`chat_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`chat_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="title" type="text" placeholder="Title of the chatroom" required={true}/>
      <Field component={this.renderField} name="status" type="text" placeholder="Status of the chatroom (active, open, ...)" required={true}/>
      <Field component={this.renderField} name="closed" type="checkbox" placeholder="The chatroom has been closed." required={true}/>
      <Field component={this.renderField} name="downvoteCount" type="number" placeholder="Negative vote for the chatroom" />
      <Field component={this.renderField} name="upvoteCount" type="number" placeholder="Positive vote for the chatroom" />
      <Field component={this.renderField} name="aggregateRating" type="number" placeholder="Aggregate rating for the chatroom" />
      <Field component={this.renderField} name="creator" type="text" placeholder="The creator of this chatroom" />
      <Field component={this.renderField} name="subjects" type="text" placeholder="Subjects tackled in this chatroom" />
      <Field component={this.renderField} name="editorInvolved" type="text" placeholder="Add an editor involved" />
      <Field component={this.renderField} name="abuses" type="text" placeholder="Abuses on this chat" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'chat', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
