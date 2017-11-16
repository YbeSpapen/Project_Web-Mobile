import React, {Component} from "react";
import {connect} from "react-redux";
import PropTypes from "prop-types";
import {Table, TableBody, TableHeader, TableHeaderColumn, TableRow, TableRowColumn} from "material-ui/Table";

const LocationsTable = (props) => {

    const handleRowSelection = (selectedRows) => {
        if (selectedRows.length !== 0) {
            const selectedRow = props.entries[selectedRows].id;
            props.changeSelected(selectedRow);
        }
    };


        const rows = props.entries.map(e => (
            <TableRow key={e.id}>
                <TableRowColumn>{e.name}</TableRowColumn>
            </TableRow>
        ));
        return (
            <Table onRowSelection={handleRowSelection}>
                <TableHeader>
                    <TableRow>
                        <TableHeaderColumn>Name</TableHeaderColumn>
                    </TableRow>
                </TableHeader>
                <TableBody deselectOnClickaway={false}>
                    {rows}
                </TableBody>
            </Table>
        )
};


LocationsTable.propTypes = {
    'entries': PropTypes.array.isRequired
};

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        changeSelected: (selectedRow) => {
            dispatch({type: 'SET_SELECTEDLOCATION', payload: selectedRow});
        }
    }
};

export default connect(undefined, mapDispatchToProps)(LocationsTable)
