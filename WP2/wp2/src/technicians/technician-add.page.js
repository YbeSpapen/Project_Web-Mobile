/**
 * Created by Spape on 27/10/2017.
 */
import React, {Component} from 'react';
import {FlatButton, TextField} from "material-ui";
import HttpService from '../common/http-service';
import mapDispatchToProps from '../common/title-dispatch-to-props';
import {connect} from "react-redux";

class TechnicianAddPage extends Component {
    render() {
        return (
            <div>
                <form onSubmit={this.save}>
                    <TextField hintText="email" name="email" type="email"/><br />
                    <TextField hintText="name" name="name" type="name"/><br />
                    <TextField hintText="password" name="password" type="password"/><br />
                    <FlatButton label="Send" type="submit"/>
                </form>
            </div>
        );
    }

    save = (ev) => {
        ev.preventDefault();
        const email = ev.target['email'].value;
        const name = ev.target['name'].value;
        const role = "ROLE_TECHNICIAN";
        const password = ev.target['password'].value;
        const technician = {
            "email": email,
            "name": name,
            "role": role,
            "password": password,
        };
        HttpService.addTechnicianEntry(technician);
    }

    componentDidMount() {
        this.props.setTitle('Add technician');
    }
}

export default connect(undefined, mapDispatchToProps)(TechnicianAddPage)