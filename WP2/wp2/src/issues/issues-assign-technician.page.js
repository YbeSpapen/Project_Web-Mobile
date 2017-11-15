import React, {Component} from "react";
import HttpService from "../common/http-service";
import TechniciansTable from "../technicians/technicians-table";
import {connect} from "react-redux";
import {RaisedButton} from "material-ui";
import {Redirect} from "react-router";
import mapDispatchToPropsTitle from "../common/title-dispatch-to-props";

class IssueAssignPage extends Component {

    constructor() {
        super();
        this.state = {
            open: false,
            submit : false,
            entries:[]
        };
    }

    componentWillMount() {
        HttpService.getTechnicians().then(fetchedEntries => this.setState({entries: fetchedEntries}))
    }

    render() {
        const fetchedEntries = this.state.entries || [];
        if (this.state.submit === true) {
            return (<Redirect to="/locations" />);
        } else {
            return (
                <div>
                    <TechniciansTable entries={fetchedEntries}/>
                    <RaisedButton label="Send" onClick={this.handleAssign} primary={true} style={{margin: "10px"}}/>
                </div>
            );
        }
    }

    handleAssign = () => {
        const issue_id = parseInt(this.props.selectedRow,10);
        const technician_id = parseInt(this.props.technician_id,10);
        const issue = {
            "issue_id": issue_id,
            "technician_id": technician_id
        };
        HttpService.assignTechnician(issue);
        this.setState({submit: true});
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

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        ...mapDispatchToPropsTitle(dispatch, ownProps)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(IssueAssignPage)
