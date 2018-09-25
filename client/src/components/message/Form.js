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
      <label htmlFor={`message_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`message_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="content" type="text" placeholder="Content of the message" required={true}/>
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of the message's creation" />
      <Field component={this.renderField} name="sanctioned" type="checkbox" placeholder="The message is an abuse" />
      <Field component={this.renderField} name="downvoteCount" type="number" placeholder="Negative vote for the message" />
      <Field component={this.renderField} name="upvoteCount" type="number" placeholder="Positive vote for the message" />
      <Field component={this.renderField} name="attachmentFile" type="text" placeholder="File attached to the message" />
      <Field component={this.renderField} name="attachmentImage" type="text" placeholder="Image attached to the message" />
      <Field component={this.renderField} name="attachmentUrl" type="text" placeholder="URL attached to the message" />
      <Field component={this.renderField} name="editor" type="text" placeholder="Editor who created the message" />
      <Field component={this.renderField} name="chatroom" type="text" placeholder="Chat within the message is written" />
      <Field component={this.renderField} name="abuses" type="text" placeholder="" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'message', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
