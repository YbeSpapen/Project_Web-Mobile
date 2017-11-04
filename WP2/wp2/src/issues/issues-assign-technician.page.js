import React, {Component} from 'react';
import HttpService from '../common/http-service';
import TechniciansTable from '../technicians/technicians-table';
import mapDispatchToProps from '../common/title-dispatch-to-props';
import {connect} from "react-redux";
import {RaisedButton, Snackbar} from "material-ui";

class IssueAssignPage extends Component {

    constructor() {
        super();
        this.state = {entries: []};
        this.state = {
            open: false
        };
    }

    handleRequestClose = () => {
        this.setState({
            open: false,
        });
    };

    componentWillMount() {
        HttpService.getTechnicians().then(fetchedEntries => this.setState({entries: fetchedEntries}))
    }

    render() {
        const fetchedEntries = this.state.entries || [];
        return (
            <div>
                <TechniciansTable entries={fetchedEntries}/>
                <RaisedButton label="Send" onClick={this.handleAssign} primary={true} style={{margin: "10px"}}/>
                <Snackbar open={this.state.open} message="Issue assigned" autoHideDuration={4000}
                          onRequestClose={this.handleRequestClose}/>
            </div>
        );
    }

    handleAssign = (event) => {
        const issue_id = parseInt(this.props.selectedRow);
        const technician_id = parseInt(this.props.technician_id);
        const issue = {
            "issue_id": issue_id,
            "technician_id": technician_id
        };
        HttpService.assignTechnician(issue);
        this.setState({open: true});
    };

    componentDidMount() {
        this.props.setTitle('Assign technician');
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        selectedRow: state.selectedRow,
        technician_id: state.technician_id
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(IssueAssignPage)
