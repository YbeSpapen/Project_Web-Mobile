/**
 * Created by Spape on 24/10/2017.
 */
import React, {Component} from 'react';
import {RaisedButton} from "material-ui";
import {Image} from 'material-ui-image'
import HttpService from '../common/http-service';
import {connect} from "react-redux";
import mapDispatchToProps from '../common/title-dispatch-to-props';
import imageGreen from '../images/green-smiley.png';
import imageRed from '../images/red-smiley.png';
import imageLightRed from '../images/lightred-smiley.png';

class StatusAddPage extends Component {

    constructor(props) {
        super(props);
        this.state = {
            open: false,
        };
    }

    render() {
        return (
            <div>
                <RaisedButton><Image src={imageGreen} alt="my image" name={"HAPPY"} onClick={this.save.bind(this,"HAPPY")}  /></RaisedButton>
                <RaisedButton><Image src={imageLightRed} alt="my image" name={"MEDIUM"} onClick={this.save.bind(this,"MEDIUM")} /></RaisedButton>
                <RaisedButton><Image src={imageRed} alt="my image" name={"MAD"} onClick={this.save.bind(this,"MAD")} /></RaisedButton>

            </div>
        );
    }

    save = function(text,e) {
        const mood =text;
        const location_id = parseInt(this.props.selectedRow);
        const date = new Date(Date.now()).toISOString().slice(0, 19).replace('T', ' ');
        const status = {
            "location_id": location_id,
            "status": mood,
            "date": date
        };
        HttpService.addStatus(status);
        this.setState({open: true});

    };

    componentDidMount() {
        this.props.setTitle('Add Status');
    }
}
const mapStateToProps = (state, ownProps) => {
    return {
        selectedRow: state.selectedRow,
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(StatusAddPage)