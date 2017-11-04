import React, {Component} from 'react';
import {connect} from "react-redux";
import HttpService from '../common/http-service';
import IssuesTable from '../issues/issues-table';
import mapDispatchToProps from '../common/title-dispatch-to-props';

class TechnicianIssuesPage extends Component {

    constructor() {
        super();
        this.state = {
            issues: []
        }
    }

    componentWillMount() {
        HttpService.getIssuesOfTechnician(this.props.technician_id).then(fetchedIssues => this.setState({issues: fetchedIssues}));
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
        technician_id: state.technician_id,
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(TechnicianIssuesPage);