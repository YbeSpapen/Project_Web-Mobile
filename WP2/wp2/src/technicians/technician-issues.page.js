import React, {Component} from 'react';
import {connect} from "react-redux";
import HttpService from '../common/http-service';
import IssuesTable from '../issues/issues-table';
import mapDispatchToProps from '../common/title-dispatch-to-props';

import {
    BrowserRouter as Router,
    Route,
    Link
} from 'react-router-dom'

class TechnicianIssuesPage extends Component {
    constructor() {
        super();
        this.state = {
            issues: []
        }
    }

    componentWillMount() {
        HttpService.getIssuesOfTechnician(this.props.selectedRow).then(fetchedIssues => this.setState({issues: fetchedIssues}));
    }

    render() {
        const issues = this.state.issues || [];
        return (
            <div>
                <h1>Issues</h1>
                <IssuesTable entries={issues}/>
            </div>
        );
    }

    componentDidMount() {
        this.props.setTitle('Overview');
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        selectedRow: state.selectedRow,
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(TechnicianIssuesPage);