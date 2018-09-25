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
      <label htmlFor={`video_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`video_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="title" type="text" placeholder="Title of the video" />
      <Field component={this.renderField} name="caption" type="text" placeholder="Short description of the video" required={true}/>
      <Field component={this.renderField} name="url" type="text" placeholder="URL of the video" />
      <Field component={this.renderField} name="embedUrl" type="text" placeholder="External URL of the video" />
      <Field component={this.renderField} name="size" type="number" placeholder="Size of the video" />
      <Field component={this.renderField} name="uploadDate" type="dateTime" placeholder="Date of the upload on the server" />
      <Field component={this.renderField} name="thumbnail" type="text" placeholder="Thumbnail image for the video" />
      <Field component={this.renderField} name="associatedArticle" type="text" placeholder="Article associated to the video" />
      <Field component={this.renderField} name="associatedExample" type="text" placeholder="Example associated to the video" />
      <Field component={this.renderField} name="associatedGrain" type="text" placeholder="Grain associated to the video" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'video', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
