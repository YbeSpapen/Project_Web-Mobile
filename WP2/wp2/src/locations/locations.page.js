import React, {Component} from "react";
import HttpService from "../common/http-service";
import LocationsTable from "./locations-table";
import RaisedButton from "material-ui/RaisedButton";
import mapDispatchToPropsTitle from "../common/title-dispatch-to-props";
import {connect} from "react-redux";
import {Link} from "react-router-dom";
import {FloatingActionButton} from "material-ui";
import ContentAdd from "material-ui/svg-icons/content/add";

class LocationsPage extends Component {

    constructor() {
        super();
        this.state = {entries: [], percentage: 0};
    }

    componentWillMount() {
        HttpService.getLocations().then(fetchedEntries => this.props.setEntries(fetchedEntries));
        HttpService.getStatusPercentage().then(percentage => this.setState({percentage: percentage}));
    }

    render() {
        const locations = this.props.locations || [];
        return (
            <div>
                <h3>Average of happy status : {parseInt(this.state.percentage, 10)}%</h3>
                <LocationsTable entries={locations}/>
                <Link to="/overview"><RaisedButton label="Go to overview" primary={true}
                                                   style={{margin: '10px'}}/></Link>
                <Link to="/addLocation"><FloatingActionButton style={{
                    position: 'fixed',
                    right: '15px',
                    bottom: '15px'
                }}><ContentAdd /></FloatingActionButton></Link>
            </div>
        );
    }

    componentDidMount() {
        this.props.setTitle('Locations');
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        locations: state.locations,
    };
};

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        ...mapDispatchToPropsTitle(dispatch, ownProps),
        setEntries: (entries) => {
            dispatch({type: 'SET_LOCATIONENTRIES', payload: entries});
        },
    }
};


export default connect(mapStateToProps, mapDispatchToProps)(LocationsPage)