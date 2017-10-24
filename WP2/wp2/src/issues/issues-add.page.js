/**
 * Created by Spape on 24/10/2017.
 */
import React, {Component} from 'react';
import {FlatButton, TextField} from "material-ui";
import HttpService from '../common/http-service';
import {connect} from "react-redux";

class IssuesAddPage extends Component {
    render() {
        return (
            <div>
                <form onSubmit={this.save}>
                    <TextField hintText="problem" name="problem" type="text"/>
                    <FlatButton label="Send" type="submit"/>
                </form>
            </div>
        );
    }

    save = (ev) => {
        ev.preventDefault();
        const problem = ev.target['problem'].value;
        const date = new Date(Date.now()).toLocaleString();
        const location_id = this.props.selectedRow;
        const issue = {
            "problem": problem,
            "date": date,
            "handled": 0,
            "location_id": location_id
        };
        HttpService.addIssueEntry(issue);
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        selectedRow: state.selectedRow,
    };
};

export default connect(mapStateToProps)(IssuesAddPage)
