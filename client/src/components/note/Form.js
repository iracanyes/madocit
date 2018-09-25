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
      <label htmlFor={`note_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`note_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="content" type="text" placeholder="Content of the note" required={true}/>
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of creation" />
      <Field component={this.renderField} name="dateModified" type="dateTime" placeholder="Date of the last modification" />
      <Field component={this.renderField} name="rating" type="number" placeholder="Average rating for the note" />
      <Field component={this.renderField} name="isValid" type="checkbox" placeholder="Note is validated" />
      <Field component={this.renderField} name="editor" type="text" placeholder="Editor who created the note" />
      <Field component={this.renderField} name="moderator" type="text" placeholder="A moderator validate notes shown on the page" />
      <Field component={this.renderField} name="subject" type="text" placeholder="A subject which is annotated" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'note', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
