/**
 * Created by Spape on 19/10/2017.
 */
import React, {Component} from 'react';
import mapDispatchToProps from './common/title-dispatch-to-props';
import {connect} from "react-redux";

class HomePage extends Component {
    render() {
        return (
            <div>
                <h2>Home</h2>
                <h3>WP2</h3>
                <span>Teamleden: Ybe Spapen, Robbe Kimpen, Brecht Philips</span>
            </div>
        );
    }

    componentDidMount() {
        this.props.setTitle('Home');
    }
}

export default connect(undefined, mapDispatchToProps)(HomePage)