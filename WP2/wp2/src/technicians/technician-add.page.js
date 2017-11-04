import React, {Component} from 'react';
import {RaisedButton, Snackbar, TextField} from "material-ui";
import HttpService from '../common/http-service';
import mapDispatchToProps from '../common/title-dispatch-to-props';
import {connect} from "react-redux";

class TechnicianAddPage extends Component {

    constructor(props) {
        super(props);
        this.state = {
            open: false,
        };
    }

    handleRequestClose = () => {
        this.setState({
            open: false,
        });
    };

    render() {
        return (
            <div className="wrapper">
                <form onSubmit={this.save} style={{marginTop: '10px'}} ref={(el) => this.form = el}>
                    <TextField hintText="email" name="email" type="email"/><br />
                    <TextField hintText="name" name="name" type="name"/><br />
                    <TextField hintText="password" name="password" type="password"/><br />
                    <RaisedButton label="Send" type="submit" primary={true} style={{marginTop: '10px', width: '100%'}}/>
                    <Snackbar open={this.state.open} message="Technician added!" autoHideDuration={4000}
                              onRequestClose={this.handleRequestClose}/>
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
        this.setState({open: true});
        this.form.reset();
    };

    componentDidMount() {
        this.props.setTitle('Add technician');
    }
}

export default connect(undefined, mapDispatchToProps)(TechnicianAddPage)