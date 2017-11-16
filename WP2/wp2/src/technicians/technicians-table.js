import React from "react";
import PropTypes from "prop-types";
import {Table, TableBody, TableHeader, TableHeaderColumn, TableRow, TableRowColumn} from "material-ui/Table";
import {connect} from "react-redux";

const TechniciansTable = (props) => {

    const handleRowSelection = (selectedRows) => {
        if (selectedRows.length !== 0) {
            const selectedRow = props.entries[selectedRows].id;
            props.changeSelected(selectedRow);
        }
    };

    const rows = props.entries.map(e => (
        <TableRow key={e.id}>
            <TableRowColumn>{e.email}</TableRowColumn>
            <TableRowColumn>{e.name}</TableRowColumn>
        </TableRow>
    ));
    return (
        <Table onRowSelection={handleRowSelection}>
            <TableHeader>
                <TableRow>
                    <TableHeaderColumn>Email</TableHeaderColumn>
                    <TableHeaderColumn>Name</TableHeaderColumn>
                </TableRow>
            </TableHeader>
            <TableBody deselectOnClickaway={false}>
                {rows}
            </TableBody>
        </Table>
    )
};

TechniciansTable.propTypes = {
    'entries': PropTypes.array.isRequired
};

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        changeSelected: (selectedRow) => {
            dispatch({type: 'SET_SELECTEDTECHNICIAN', payload: selectedRow});
        }
    }
};

export default connect(undefined, mapDispatchToProps)(TechniciansTable)