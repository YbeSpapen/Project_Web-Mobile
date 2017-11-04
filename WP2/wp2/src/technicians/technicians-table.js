import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {
    Table,
    TableBody,
    TableHeader,
    TableHeaderColumn,
    TableRow,
    TableRowColumn,
} from 'material-ui/Table';
import {connect} from "react-redux";

class TechniciansTable extends Component {

    handleRowSelection = (selectedRows) => {
        if (selectedRows.length !== 0) {
            const selectedRow = this.props.entries[selectedRows].id;
            this.props.changeSelected(selectedRow);
        }
    };

    render() {
        const rows = this.props.entries.map(e => (
            <TableRow key={e.id}>
                <TableRowColumn>{e.email}</TableRowColumn>
                <TableRowColumn>{e.name}</TableRowColumn>
            </TableRow>
        ));
        return (
            <Table onRowSelection={this.handleRowSelection}>
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
    }
}

TechniciansTable.propTypes = {
    'entries': PropTypes.array.isRequired
};

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        changeSelected: (selectedRow) => {
            dispatch({type: 'ASSIGN_TECHNICIAN_ID', payload: selectedRow});
        }
    }
};

export default connect(undefined, mapDispatchToProps)(TechniciansTable)