import React, {Component} from 'react';
import HttpService from '../common/http-service';
import TechniciansTable from '../technicians/technicians-table';
import mapDispatchToProps from '../common/title-dispatch-to-props';
import {connect} from "react-redux";
import {RaisedButton, Snackbar} from "material-ui";
import {
    BrowserRouter as Router,
    Route,
    Link
} from 'react-router-dom'

class IssueAssignPage extends Component {

    constructor() {
        super();
        this.state = {entries: []}
    }

    componentWillMount() {
        HttpService.getTechnicians().then(fetchedEntries => this.setState({entries: fetchedEntries}))
    }

    handleRequestClose = () => {
        this.setState({
            open: false,
        });
    };

    render() {
        const fetchedEntries = this.state.entries || [];
        return (
            <div className="wrapper">
                <form onSubmit={this.save} className="marginTop" ref={(el) => this.form = el}>
                    <TechniciansTable entries={fetchedEntries}/>
                    <RaisedButton label="Send" type="submit" primary={true} style={{marginTop: '10px', width: '100%'}}/>
                    <Snackbar open={this.state.open} message="Issue assigned!" autoHideDuration={4000}
                              onRequestClose={this.handleRequestClose}/>
                </form>
            </div>
        );
    }

    save = (ev) => {
        ev.preventDefault();
        const id = parseInt(this.props.selectedRow).id;
        const technician_id = parseInt(this.props.selectedRow);
        //issue_id!
        const issue = {
            "issue_id": id,
            "technician_id" : technician_id
        };
        HttpService.assignTechnician(issue);
        this.setState({open: true});
        this.form.reset();
    };

    componentDidMount() {
        this.props.setTitle('Assign issue');
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        selectedRow: state.selectedRow,
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(IssueAssignPage)
