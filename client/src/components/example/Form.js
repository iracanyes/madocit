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
      <label htmlFor={`example_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`example_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="title" type="text" placeholder="Title of the example" required={true}/>
      <Field component={this.renderField} name="content" type="text" placeholder="Content of the example" required={true}/>
      <Field component={this.renderField} name="rating" type="number" placeholder="Average votes made by other users" />
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of creation" />
      <Field component={this.renderField} name="dateModified" type="dateTime" placeholder="Date of the last modification" />
      <Field component={this.renderField} name="pdf" type="text" placeholder="URL of the pdf" />
      <Field component={this.renderField} name="associatedArticles" type="text" placeholder="Articles associated to the example" />
      <Field component={this.renderField} name="associatedGrains" type="text" placeholder="Articles associated to the example" />
      <Field component={this.renderField} name="video" type="text" placeholder="Video associated to the example" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'example', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
