import React, {Component} from "react";
import {RaisedButton, Snackbar, TextField} from "material-ui";
import HttpService from "../common/http-service";
import {connect} from "react-redux";
import mapDispatchToProps from "../common/title-dispatch-to-props";
import {Redirect} from "react-router";

class IssuesAddPage extends Component {

    constructor(props) {
        super(props);
        this.state = {
            submit : false,
        };
    }

    render() {
        if (this.state.submit === true) {
            return (<Redirect to="/"/>);
        } else {
            return (
                <div className="wrapper">
                    <form onSubmit={this.save} className="marginTop" ref={(el) => this.form = el}>
                        <TextField hintText="problem" name="problem" type="text"/><br/>
                        <RaisedButton label="Send" type="submit" primary={true}
                                      style={{marginTop: '10px', width: '100%'}}/>
                    </form>
                </div>
            );
        }
    }

    save = (ev) => {
        ev.preventDefault();
        const problem = ev.target['problem'].value;
        const offset = (new Date()).getTimezoneOffset() * 60000;
        const date = new Date(Date.now() - offset).toISOString().slice(0, 19).replace('T', ' ');
        const location_id = parseInt(this.props.location_id, 10);
        const issue = {
            "problem": problem,
            "date": date,
            "handled": 0,
            "location_id": location_id
        };
        HttpService.addIssueEntry(issue);
        this.setState({submit: true});
    };

    componentDidMount() {
        this.props.setTitle('Add issue');
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        location_id: state.location_id,
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(IssuesAddPage)
