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
      <label htmlFor={`abuse_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`abuse_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="description" type="text" placeholder="Description of the abuse" />
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of the creation of the abuse" />
      <Field component={this.renderField} name="accuser" type="text" placeholder="Editor who identify" required={true}/>
      <Field component={this.renderField} name="defendant" type="text" placeholder="Charged person" required={true}/>
      <Field component={this.renderField} name="chat" type="text" placeholder="Chatroom of the abuse" required={true}/>
      <Field component={this.renderField} name="sanction" type="text" placeholder="Sanction for this abuse" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'abuse', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
