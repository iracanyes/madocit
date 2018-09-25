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
      <label htmlFor={`image_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`image_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="place" type="number" placeholder="Place of the image (1-5)." />
      <Field component={this.renderField} name="title" type="text" placeholder="Title of the image (optional)" />
      <Field component={this.renderField} name="url" type="text" placeholder="URL of the image" />
      <Field component={this.renderField} name="alt" type="text" placeholder="Alternative title for the image (optional)" />
      <Field component={this.renderField} name="size" type="number" placeholder="Size of the image" />
      <Field component={this.renderField} name="user" type="text" placeholder="User represented by the image" />
      <Field component={this.renderField} name="category" type="text" placeholder="Category illustrated by the image" />
      <Field component={this.renderField} name="theme" type="text" placeholder="Theme illustrated by the image" />
      <Field component={this.renderField} name="subject" type="text" placeholder="Subject illustrated bu the image" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'image', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
