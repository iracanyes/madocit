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
      <label htmlFor={`group_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`group_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="name" type="text" placeholder="Name of the group" />
      <Field component={this.renderField} name="description" type="text" placeholder="Description of the group" />
      <Field component={this.renderField} name="owner" type="text" placeholder="Owner of this group" />
      <Field component={this.renderField} name="members" type="text" placeholder="" />
      <Field component={this.renderField} name="privileges" type="text" placeholder="Privileges owned by the group" />
      <Field component={this.renderField} name="contributions" type="text" placeholder="Contributions made by the members of this group" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'group', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
