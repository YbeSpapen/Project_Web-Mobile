import React, {Component} from "react";
import HttpService from "../common/http-service";
import TechniciansTable from "./technicians-table";
import RaisedButton from "material-ui/RaisedButton";
import mapDispatchToPropsTitle from "../common/title-dispatch-to-props";
import {Link} from "react-router-dom";
import {connect} from "react-redux";
import {FloatingActionButton} from "material-ui";
import ContentAdd from "material-ui/svg-icons/content/add";

class TechniciansPage extends Component {

    constructor() {
        super();
        this.state = {entries: []}
    }

    componentWillMount() {
        HttpService.getTechnicians().then(fetchedEntries => this.props.setEntries(fetchedEntries));
    }

    render() {
        const technicians = this.props.technicians || [];
        return (
            <div>
                <TechniciansTable entries={technicians}/>
                <Link to="/addTechnician"><FloatingActionButton style={{
                    position: 'fixed',
                    right: '15px',
                    bottom: '15px'
                }}><ContentAdd /></FloatingActionButton></Link>
                <Link to="/technicianIssues"><RaisedButton label="Issues" primary={true}
                                                           style={{margin: '10px'}}/></Link>
            </div>
        );
    }

    componentDidMount() {
        this.props.setTitle('Technicians');
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        technicians: state.technicians,
    };
};

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        ...mapDispatchToPropsTitle(dispatch, ownProps),
        setEntries: (entries) => {
            dispatch({type: 'SET_TECHNICIANENTRIES', payload: entries});
        },
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(TechniciansPage)