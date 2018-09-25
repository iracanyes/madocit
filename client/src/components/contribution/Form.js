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
      <label htmlFor={`contribution_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`contribution_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="title" type="text" placeholder="Title of the contribution (optional)." required={true}/>
      <Field component={this.renderField} name="content" type="text" placeholder="Content of the contribution." required={true}/>
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of the contribution" />
      <Field component={this.renderField} name="dateModified" type="dateTime" placeholder="Date of the last modification of the contribution" />
      <Field component={this.renderField} name="editor" type="text" placeholder="Editor who made this contribution" required={true}/>
      <Field component={this.renderField} name="subject" type="text" placeholder="Subject which is concerned by this contribution" required={true}/>

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'contribution', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
