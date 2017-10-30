/**
 * Created by Spape on 27/10/2017.
 */
import React, {Component} from 'react';
import HttpService from '../common/http-service';
import TechniciansTable from './technicians-table';
import RaisedButton from 'material-ui/RaisedButton';
import mapDispatchToProps from '../common/title-dispatch-to-props';
import {
    BrowserRouter as Router,
    Route,
    Link
} from 'react-router-dom'
import {connect} from "react-redux";

class TechniciansPage extends Component {

    constructor() {
        super();
        this.state = {entries: []}
    }

    componentWillMount() {
        HttpService.getTechnicians().then(fetchedEntries => this.setState({entries: fetchedEntries}))
    }

    render() {
        const fetchedEntries = this.state.entries || [];
        return (
            <div>
                <TechniciansTable entries={fetchedEntries}/>
                <Link to="/addTechnician"><RaisedButton label="Add technician" primary={true}
                                                        style={{margin: '10px'}}></RaisedButton></Link>
            </div>
        );
    }

    componentDidMount() {
        this.props.setTitle('Technicians');
    }
}

export default connect(undefined, mapDispatchToProps)(TechniciansPage)