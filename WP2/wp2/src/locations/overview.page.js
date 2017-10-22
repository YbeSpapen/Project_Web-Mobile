/**
 * Created by Spape on 21/10/2017.
 */
import React, {Component} from 'react';
import {connect} from "react-redux";
import HttpService from '../common/http-service';
import IssuesTable from '../issues/issues-table';
import StatusesTable from '../statuses/status-table';

class OverviewPage extends Component {
    constructor() {
        super();
        this.state = {
            issues: [],
            statuses: []
        }
    }

    componentWillMount() {
        console.log(this.props.selectedRow);
        //HttpService.getIssuesOfLocatiton(this.props.selectedRow.id).then(fetchedEntries => this.setState({issues: fetchedEntries}));
        //HttpService.getStatusesOfLocation(this.props.selectedRow.id).then(fetchedEntries => this.setState({statuses: fetchedEntries}));
    }

    render() {
        const issues = this.state.issues || [];
        const statuses = this.state.statuses || [];
        return (
            <div>
                <IssuesTable entries={issues}/>
                <StatusesTable entries={statuses}/>
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