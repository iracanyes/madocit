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
      <label htmlFor={`version_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`version_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="assemblyVersion" type="text" placeholder="Associated product/technology version. e.g., .NET Framework 4.5." required={true}/>
      <Field component={this.renderField} name="executableLibraryName" type="text" placeholder="Library file name e.g., mscorlib.dll, system.web.dll. Supersedes assembly." />
      <Field component={this.renderField} name="programmingModel" type="text" placeholder="Indicates whether API is managed or unmanaged." />
      <Field component={this.renderField} name="targetPlatform" type="text" placeholder="Type of app development: phone, Metro style, desktop, XBox, etc." />
      <Field component={this.renderField} name="isValid" type="checkbox" placeholder="Version is validated" />
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Date of creation" />
      <Field component={this.renderField} name="author" type="text" placeholder="Author of the version (optional)" />
      <Field component={this.renderField} name="theme" type="text" placeholder="Theme associated with this version" />
      <Field component={this.renderField} name="subjects" type="text" placeholder="Subjects tackling this version of the theme" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'version', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
