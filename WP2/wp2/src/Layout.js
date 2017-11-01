/**
 * Created by Spape on 19/10/2017.
 */
import React, {Component} from 'react';
import AppBar from 'material-ui/AppBar';
import Drawer from 'material-ui/Drawer';
import MenuItem from 'material-ui/MenuItem';
import HomePage from './home.page';
import LocationsPage from './locations/locations.page';
import OverviewPage from './locations/overview.page'
import IssueAddPage from './issues/issues-add.page';
import TechniciansPage from './technicians/technicians.page';
import TechnicianAddPage from './technicians/technician-add.page';
import TechnicianIssuesPage from './technicians/technician-issues.page';
import LocationAddPage from './locations/location-add.page';
import {connect} from "react-redux";
import {
    BrowserRouter as Router,
    Route,
    Link
} from 'react-router-dom';


class Layout extends Component {
    constructor() {
        super();
        this.state = {drawerOpen: false};
    }

    toggleState = () => {
        const currentState = this.state.drawerOpen;
        this.setState({drawerOpen: !currentState})
    };

    render() {
        return (
            <Router>
                <div>
                    <AppBar
                        title={this.props.title}
                        onLeftIconButtonTouchTap={this.toggleState}
                    />
                    <Drawer open={this.state.drawerOpen}>
                        <MenuItem onClick={this.toggleState} containerElement={<Link to="/"></Link>}>Home</MenuItem>
                        <MenuItem onClick={this.toggleState}
                                  containerElement={<Link to="/locations"></Link>}>Locations</MenuItem>
                        <MenuItem onClick={this.toggleState}
                                  containerElement={<Link to="/technicians"></Link>}>Technicians</MenuItem>
                    </Drawer>
                    <Route exact={true} path="/" component={HomePage}/>
                    <Route path="/locations" component={LocationsPage}/>
                    <Route path="/technicians" component={TechniciansPage}/>
                    <Route path="/addTechnician" component={TechnicianAddPage}/>
                    <Route path="/overview" component={OverviewPage}/>
                    <Route path="/addIssue" component={IssueAddPage}/>
                    <Route path="/addLocation" component={LocationAddPage}/>
                    <Route path="/technicianIssues" component={TechnicianIssuesPage}/>
                </div>
            </Router>
        );
    }
}
const mapStateToProps = (state, ownProps) => {
    return {
        title: state.title,
    }
}

export default connect(mapStateToProps)(Layout);