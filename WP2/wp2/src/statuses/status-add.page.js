import React, {Component} from 'react';
import {Image} from 'material-ui-image'
import HttpService from '../common/http-service';
import {connect} from "react-redux";
import mapDispatchToProps from '../common/title-dispatch-to-props';
import imageGreen from '../images/green-smiley.png';
import imageRed from '../images/red-smiley.png';
import imageLightRed from '../images/lightred-smiley.png';
import {Col, Grid, Row} from "react-bootstrap";
import {Snackbar} from "material-ui";

class StatusAddPage extends Component {

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
            <Grid>
                <Row style={{marginTop: '30px'}}>
                    <Col md={4} lg={4}>
                        <Image src={imageGreen} alt="HAPPY" name={"HAPPY"}
                               onClick={() => this.save("HAPPY")} color="white" style={{cursor: 'pointer'}}/>
                    </Col>
                    <Col md={4} lg={4}>
                        <Image src={imageLightRed} alt="MEDIUM" name={"MEDIUM"}
                               onClick={() => this.save("MEDIUM")} color="white" style={{cursor: 'pointer'}}/>
                    </Col>
                    <Col md={4} lg={4}>
                        <Image src={imageRed} alt="MAD" name={"MAD"} onClick={() => this.save("MAD")}
                               color="white" style={{cursor: 'pointer'}}/>
                    </Col>
                </Row>
                <Snackbar open={this.state.open} message="Status added!" autoHideDuration={4000}
                          onRequestClose={this.handleRequestClose}/>
            </Grid>
        );
    }

    save = (text) => {
        const mood = text;
        const location_id = parseInt(this.props.selectedRow, 10);
        const offset = (new Date()).getTimezoneOffset() * 60000;
        const date = new Date(Date.now() - offset).toISOString().slice(0, 19).replace('T', ' ');
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