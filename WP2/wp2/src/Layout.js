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

import {
    BrowserRouter as Router,
    Route,
    Link
} from 'react-router-dom'

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
                        title="WP3"
                        onLeftIconButtonTouchTap={this.toggleState}
                    />
                    <Drawer open={this.state.drawerOpen}>
                        <MenuItem onClick={this.toggleState} containerElement={<Link to="/"></Link>}>Home</MenuItem>
                        <MenuItem onClick={this.toggleState} containerElement={<Link to="/locations"></Link>}>Locations</MenuItem>
                    </Drawer>
                    <Route exact={true} path="/" component={HomePage}/>
                    <Route path="/locations" component={LocationsPage}/>
                    <Route path="/overview" component={OverviewPage}/>
                </div>
            </Router>
        );
    }
}

export default Layout