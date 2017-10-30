/**
 * Created by Spape on 19/10/2017.
 */
import React, {Component} from 'react';
import HttpService from '../common/http-service';
import LocationsTable from './locations-table';
import RaisedButton from 'material-ui/RaisedButton';
import mapDispatchToProps from '../common/title-dispatch-to-props';
import {connect} from "react-redux";
import {
    BrowserRouter as Router,
    Route,
    Link
} from 'react-router-dom'

class LocationsPage extends Component {

    constructor() {
        super();
        this.state = {entries: [], percentage: 0};
    }

    componentWillMount() {
        HttpService.getLocations().then(fetchedEntries => this.setState({entries: fetchedEntries}));
        HttpService.getStatusPercentage().then(percentage => this.setState({percentage: percentage}));
    }

    render() {
        const fetchedEntries = this.state.entries || [];
        return (
            <div>
                <p>{this.state.percentage}</p>
                <LocationsTable entries={fetchedEntries}/>
                <Link to="/overview"><RaisedButton label="Go to overview" primary={true} style={{margin: '10px'}}/></Link>
                <Link to="/addLocation"><RaisedButton label="Add location" primary={true} style={{margin: '10px'}}/></Link>
            </div>
        );
    }

    componentDidMount() {
        this.props.setTitle('Locations');
    }
}

export default connect(undefined, mapDispatchToProps)(LocationsPage)