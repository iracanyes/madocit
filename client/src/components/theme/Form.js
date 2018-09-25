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
      <label htmlFor={`theme_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`theme_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="name" type="text" placeholder="Name of the theme" />
      <Field component={this.renderField} name="description" type="text" placeholder="Description of the theme" required={true}/>
      <Field component={this.renderField} name="isValid" type="checkbox" placeholder="The theme has been validated" />
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of the creation" />
      <Field component={this.renderField} name="image" type="text" placeholder="Image illustrating the category" />
      <Field component={this.renderField} name="categories" type="text" placeholder="Categories of the theme" />
      <Field component={this.renderField} name="versions" type="text" placeholder="Versions of the theme" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'theme', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
