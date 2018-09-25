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
      <label htmlFor={`grain_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`grain_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="content" type="text" placeholder="Content of the grain (piece of article)" required={true}/>
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of the creation" />
      <Field component={this.renderField} name="dateModified" type="dateTime" placeholder="Date of the last modification" />
      <Field component={this.renderField} name="datePublished" type="dateTime" placeholder="Date of the publication" />
      <Field component={this.renderField} name="draft" type="checkbox" placeholder="The grain is a draft" />
      <Field component={this.renderField} name="rating" type="number" placeholder="Average votes made by other users" />
      <Field component={this.renderField} name="about" type="text" placeholder="Subject matter of the content" />
      <Field component={this.renderField} name="associatedExamples" type="text" placeholder="Associated examples" />
      <Field component={this.renderField} name="video" type="text" placeholder="Video associated to the grain" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'grain', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
