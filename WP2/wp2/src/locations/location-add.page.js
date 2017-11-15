import React, {Component} from "react";
import {RaisedButton, TextField} from "material-ui";
import HttpService from "../common/http-service";
import {connect} from "react-redux";
import {Redirect} from "react-router";
import mapDispatchToPropsTitle from "../common/title-dispatch-to-props";

class LocationAddPage extends Component {

    constructor(props) {
        super(props);
        this.state = {
            submit: false,
            name: "",
        };
    }

    render() {
        if (this.state.submit === true) {
            return (<Redirect to="/locations"/>);
        } else {
            return (
                <div className="wrapper">
                    <form onSubmit={this.save} className="marginTop" ref={(el) => this.form = el}>
                        <TextField type="text" value={this.state.name}
                                   onChange={(event) => this.setState({name: event.target.value})}
                                   hintText="name"/><br/>
                        <RaisedButton label="Send" type="submit" primary={true} style={{marginTop: '10px', width: '100%'}}/>
                    </form>
                </div>
            );
        }
    }

    save = (ev) => {
        ev.preventDefault();
        const name = this.state.name;
        const location = {
            "name": name,
        };
        HttpService.addLocation(location).then(()=>{
            this.props.addLocation(location);
        });
        this.setState({submit: true});
    };

    componentDidMount() {
        this.props.setTitle('Add Location');
    }
}
const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        ...mapDispatchToPropsTitle(dispatch, ownProps),
        addLocation: (entry) => {
            dispatch({type: 'ADD_LOCATIONENTRY', payload: entry});
        }
    }
};

export default connect(undefined, mapDispatchToProps)(LocationAddPage)
