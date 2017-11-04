import React, {Component} from 'react';
import {RaisedButton, TextField, Snackbar} from "material-ui";
import HttpService from '../common/http-service';
import {connect} from "react-redux";
import mapDispatchToProps from '../common/title-dispatch-to-props';

class LocationAddPage extends Component {

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
                    <TextField hintText="name" name="name" type="text"/><br/>
                    <RaisedButton label="Send" type="submit" primary={true} style={{marginTop: '10px', width: '100%'}}/>
                    <Snackbar open={this.state.open} message="Location added!" autoHideDuration={4000}
                              onRequestClose={this.handleRequestClose}/>
                </form>
            </div>
        );
    }

    save = (ev) => {
        ev.preventDefault();
        const name = ev.target['name'].value;
        const location = {
            "name": name,
        };
        HttpService.addLocation(location);
        this.setState({open: true});
        this.form.reset();
    };

    componentDidMount() {
        this.props.setTitle('Add Location');
    }
}

export default connect(undefined, mapDispatchToProps)(LocationAddPage)
