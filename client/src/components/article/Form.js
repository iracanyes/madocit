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
      <label htmlFor={`article_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`article_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="articleBody" type="text" placeholder="Body of the article" required={true}/>
      <Field component={this.renderField} name="dateCreated" type="dateTime" placeholder="Creation's date of the article" />
      <Field component={this.renderField} name="dateModified" type="dateTime" placeholder="The last modification's date of the article" />
      <Field component={this.renderField} name="datePublished" type="dateTime" placeholder="Date of publication" />
      <Field component={this.renderField} name="coursePrerequisites" type="text" placeholder="Course prerequisites for a good understanding of the article" />
      <Field component={this.renderField} name="aggregateRating" type="number" placeholder="Aggregate rating received by other users." />
      <Field component={this.renderField} name="pdf" type="text" placeholder="URI for the pdf of the given article." />
      <Field component={this.renderField} name="about" type="text" placeholder="Subject matter of this article" required={true}/>
      <Field component={this.renderField} name="associatedExamples" type="text" placeholder="Examples associated to the article" />
      <Field component={this.renderField} name="video" type="text" placeholder="Video associated to the article" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'article', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
