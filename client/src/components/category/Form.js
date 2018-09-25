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
      <label htmlFor={`category_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`category_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="name" type="text" placeholder="Name of the category" required={true}/>
      <Field component={this.renderField} name="description" type="text" placeholder="Description of the category" required={true}/>
      <Field component={this.renderField} name="isValid" type="checkbox" placeholder="The category has been validated" />
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of the creation of the category" />
      <Field component={this.renderField} name="image" type="text" placeholder="Image illustrating the category" />
      <Field component={this.renderField} name="themes" type="text" placeholder="Theme classified in the Category instance" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'category', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
