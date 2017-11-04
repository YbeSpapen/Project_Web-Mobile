import React, {Component} from 'react';
import {RaisedButton, TextField, Snackbar} from "material-ui";
import HttpService from '../common/http-service';
import {connect} from "react-redux";
import mapDispatchToProps from '../common/title-dispatch-to-props';

class IssuesAddPage extends Component {

    constructor(props) {
        super(props);
        this.state = {
            open: false,
        };
    }

    handleRequestClose = () => {
        this.setState({
            open: false,
        });
    };

    render() {
        return (
            <div className="wrapper">
                <form onSubmit={this.save} className="marginTop" ref={(el) => this.form = el}>
                    <TextField hintText="problem" name="problem" type="text"/><br/>
                    <RaisedButton label="Send" type="submit" primary={true} style={{marginTop: '10px', width: '100%'}}/>
                    <Snackbar open={this.state.open} message="Issue added!" autoHideDuration={4000}
                              onRequestClose={this.handleRequestClose}/>
                </form>
            </div>
        );
    }

    save = (ev) => {
        ev.preventDefault();
        const problem = ev.target['problem'].value;
        const date = new Date(Date.now()).toISOString().slice(0, 19).replace('T', ' ');
        const location_id = parseInt(this.props.selectedRow);
        const issue = {
            "problem": problem,
            "date": date,
            "handled": 0,
            "location_id": location_id
        };
        HttpService.addIssueEntry(issue);
        this.setState({open: true});
        this.form.reset();
    };

    componentDidMount() {
        this.props.setTitle('Add issue');
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        selectedRow: state.selectedRow,
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(IssuesAddPage)
