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
      <label htmlFor={`subject_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`subject_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="title" type="text" placeholder="Title of the subject" required={true}/>
      <Field component={this.renderField} name="description" type="text" placeholder="Description of the subject (optional)" required={true}/>
      <Field component={this.renderField} name="dependencies" type="text" placeholder="Prerequisites needed to fulfill steps in article." />
      <Field component={this.renderField} name="proficiencyLevel" type="text" placeholder="Proficiency needed for this content; expected values: 'Beginner', 'Expert'." />
      <Field component={this.renderField} name="isValid" type="checkbox" placeholder="Subject has been validated" />
      <Field component={this.renderField} name="article" type="text" placeholder="Article associated to this subject" />
      <Field component={this.renderField} name="grain" type="text" placeholder="Grain associated to this subject" />
      <Field component={this.renderField} name="author" type="text" placeholder="Editor who create this subject" />
      <Field component={this.renderField} name="hasPart" type="text" placeholder="Subjects tackled by this subject" />
      <Field component={this.renderField} name="isPartOf" type="text" placeholder="Subjects which tackle this subjects" />
      <Field component={this.renderField} name="notes" type="text" placeholder="Notes on the subject" />
      <Field component={this.renderField} name="contributionSuggested" type="text" placeholder="Add a contribution suggested" />
      <Field component={this.renderField} name="chatrooms" type="text" placeholder="Chatroom of this subject" />
      <Field component={this.renderField} name="version" type="text" placeholder="Theme's version which tackle the subject" />
      <Field component={this.renderField} name="images" type="text" placeholder="Images illustrating the subject" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'subject', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
