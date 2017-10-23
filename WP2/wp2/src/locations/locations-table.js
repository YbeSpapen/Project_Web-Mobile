/**
 * Created by Spape on 19/10/2017.
 */
import React, {Component} from 'react';
import {connect} from "react-redux";
import PropTypes from 'prop-types';
import {
    Table,
    TableBody,
    TableHeader,
    TableHeaderColumn,
    TableRow,
    TableRowColumn,
} from 'material-ui/Table';

class LocationsTable extends Component {

    handleRowSelection = (selectedRows) => {
        const selectedRow = this.props.entries[selectedRows].id;
        this.props.changeSelected(selectedRow);
    };

    render() {
        const rows = this.props.entries.map(e => (
            <TableRow key={e.id}>
                <TableRowColumn>{e.id}</TableRowColumn>
                <TableRowColumn>{e.name}</TableRowColumn>
            </TableRow>
        ));
        return (
            <Table onRowSelection={this.handleRowSelection}>
                <TableHeader>
                    <TableRow>
                        <TableHeaderColumn>#</TableHeaderColumn>
                        <TableHeaderColumn>Name</TableHeaderColumn>
                    </TableRow>
                </TableHeader>
                <TableBody deselectOnClickaway={false}>
                    {rows}
                </TableBody>
            </Table>
        )
    }
}


LocationsTable.propTypes = {
    'entries': PropTypes.array.isRequired
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        changeSelected: (selectedRow) => {
            dispatch({type: 'SET_SELECTION', payload: selectedRow});
        }
    }
}

export default connect(undefined, mapDispatchToProps)(LocationsTable)