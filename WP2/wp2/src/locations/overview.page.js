/**
 * Created by Spape on 21/10/2017.
 */
import React, { Component } from 'react';
import {connect} from "react-redux";
import HttpService from '../common/http-service';
import IssuesTable from '../issues/issues-table';
import StatusesTable from '../statuses/status-table';
import {
    BrowserRouter as Router,
    Route,
    Link
} from 'react-router-dom'
import {RaisedButton} from "material-ui";


class OverviewPage extends Component {
    constructor() {
        super();
        this.state = {
            issues: [],
            statuses: []
        }
    }

    componentWillMount() {
        HttpService.getIssuesOfLocatiton(this.props.selectedRow).then(fetchedEntries => this.setState({issues: fetchedEntries}));
        HttpService.getStatusesOfLocation(this.props.selectedRow).then(fetchedEntries => this.setState({statuses: fetchedEntries}));
    }

    render() {
        const issues = this.state.issues || [];
        const statuses = this.state.statuses || [];
        return (
            <div>
                <h1>Issues</h1>
                <IssuesTable entries={issues}/>
                <h1>Statuses</h1>
                <StatusesTable entries={statuses}/>
                <Link to="/addStatus"><RaisedButton label="Add status" primary={true} style={{ margin: '10px' }}></RaisedButton></Link>
                <Link to="/addIssue"><RaisedButton label="Add issue" primary={true} style={{ margin: '10px' }}></RaisedButton></Link>
            </div>
        );
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        selectedRow: state.selectedRow,
    };
};

export default connect(mapStateToProps)(OverviewPage);