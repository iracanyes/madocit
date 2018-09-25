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
      <label htmlFor={`editor_${data.input.name}`} className="form-control-label">{data.input.name}</label>
      <input {...data.input} type={data.type} step={data.step} required={data.required} placeholder={data.placeholder} id={`editor_${data.input.name}`}/>
      {isInvalid && <div className="invalid-feedback">{data.meta.error}</div>}
    </div>;
  }

  render() {
    const { handleSubmit } = this.props;

    return <form onSubmit={handleSubmit}>
      <Field component={this.renderField} name="emailContact" type="text" placeholder="Email for contacting the editor (optional)" />
      <Field component={this.renderField} name="nickname" type="text" placeholder="Nickname used in place of the real name" />
      <Field component={this.renderField} name="familyName" type="text" placeholder="Family name of the editor" />
      <Field component={this.renderField} name="givenName" type="text" placeholder="First name of the editor" />
      <Field component={this.renderField} name="affiliation" type="text" placeholder="School or company where the editor is affiliated to" />
      <Field component={this.renderField} name="alumniOf" type="text" placeholder="Last school of the editor" />
      <Field component={this.renderField} name="rateGlobal" type="number" placeholder="Global rate for all activities done on the platform" />
      <Field component={this.renderField} name="rateContribution" type="text" placeholder="Aggregate rating of all votes by users for all the contributions done by the editor" />
      <Field component={this.renderField} name="sanctioned" type="checkbox" placeholder="The editor is sanctioned" />
      <Field component={this.renderField} name="chatroomCreated" type="text" placeholder="Add a chatroom created" />
      <Field component={this.renderField} name="chatroomInvolved" type="text" placeholder="Add a chatroom involved" />
      <Field component={this.renderField} name="subjectCreated" type="text" placeholder="Add a subject created" />
      <Field component={this.renderField} name="noteSuggested" type="text" placeholder="Add a note suggested by this editor" />
      <Field component={this.renderField} name="contributionMade" type="text" placeholder="Add a contribution made" />
      <Field component={this.renderField} name="abuseIdentified" type="text" placeholder="Add an identified abuse" />
      <Field component={this.renderField} name="abuseAccused" type="text" placeholder="Add a charging abuse" />
      <Field component={this.renderField} name="sanctionReceived" type="text" placeholder="Add sanction received to Editor" />
      <Field component={this.renderField} name="email" type="text" placeholder="" required={true}/>
      <Field component={this.renderField} name="password" type="text" placeholder="" />
      <Field component={this.renderField} name="plainPassword" type="text" placeholder="" />
      <Field component={this.renderField} name="userType" type="text" placeholder="" />
      <Field component={this.renderField} name="nbErrorConnection" type="text" placeholder="" />
      <Field component={this.renderField} name="banned" type="checkbox" placeholder="" />
      <Field component={this.renderField} name="signinConfirmed" type="checkbox" placeholder="" />
      <Field component={this.renderField} name="dateRegistration" type="dateTime" placeholder="" />
      <Field component={this.renderField} name="apiToken" type="text" placeholder="" />
      <Field component={this.renderField} name="image" type="text" placeholder="" />

        <button type="submit" className="btn btn-success">Submit</button>
      </form>;
  }
}

export default reduxForm({form: 'editor', enableReinitialize: true, keepDirtyOnReinitialize: true})(Form);
