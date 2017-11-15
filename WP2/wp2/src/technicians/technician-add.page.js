import React, {Component} from "react";
import {RaisedButton, TextField} from "material-ui";
import HttpService from "../common/http-service";
import mapDispatchToPropsTitle from "../common/title-dispatch-to-props";
import {connect} from "react-redux";
import {Redirect} from "react-router";

class TechnicianAddPage extends Component {

    constructor(props) {
        super(props);
        this.state = {
            submit: false,
            email: "",
            name: "",
            password: ""
        };
    }

    render() {
        if (this.state.submit === true) {
            return (<Redirect to="/technicians"/>);
        } else {
            return (
                <div className="wrapper">
                    <form onSubmit={this.save} style={{marginTop: '10px'}} ref={(el) => this.form = el}>
                        <TextField type="email" value={this.state.email}
                                   onChange={(event) => this.setState({email: event.target.value})}
                                   hintText="email"/><br />
                        <TextField type="text" value={this.state.name}
                                   onChange={(event) => this.setState({name: event.target.value})}
                                   hintText="name"/><br />
                        <TextField type="password" value={this.state.password}
                                   onChange={(event) => this.setState({password: event.target.value})}
                                   hintText="password"/><br />
                        <RaisedButton label="Send" type="submit" primary={true}
                                      style={{marginTop: '10px', width: '100%'}}/>
                    </form>
                </div>
            );
        }
    }

    save = (ev) => {
        ev.preventDefault();
        const email = this.state.email;
        const name = this.state.name;
        const role = "ROLE_TECHNICIAN";
        const password = this.state.password;
        const technician = {
            "email": email,
            "name": name,
            "role": role,
            "password": password,
        };
        HttpService.addTechnicianEntry(technician).then((response) => {
            this.props.addTechnician(response.data);
        });
        this.setState({submit: true});
    };

    componentDidMount() {
        this.props.setTitle('Add technician');
    }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        ...mapDispatchToPropsTitle(dispatch, ownProps),
        addTechnician: (entry) => {
            dispatch({type: 'ADD_TECHNICIANENTRY', payload: entry});
        }
    }
};

export default connect(undefined, mapDispatchToProps)(TechnicianAddPage)