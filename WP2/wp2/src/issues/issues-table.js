import React, {Component} from "react";
import PropTypes from "prop-types";
import {connect} from "react-redux";
import {Table, TableBody, TableHeader, TableHeaderColumn, TableRow, TableRowColumn} from "material-ui/Table";

class IssuesTable extends Component {

    handleRowSelection = (selectedRows) => {
        if (selectedRows.length !== 0) {
            const selectedRow = this.props.entries[selectedRows].id;
            this.props.changeSelected(selectedRow);
        }
    };

    render() {
        const rows = this.props.entries.map(e => (
            <TableRow key={e.id}>
                <TableRowColumn>{e.problem}</TableRowColumn>
                <TableRowColumn>{e.date}</TableRowColumn>
                <TableRowColumn>{e.handled == 1 ? "Yes" : "No"}</TableRowColumn>
                <TableRowColumn>{e.technician_id > 0 ? "Yes" : "No"}</TableRowColumn>
            </TableRow>
        ));
        return (
            <Table onRowSelection={this.handleRowSelection}>
                <TableHeader>
                    <TableRow>
                        <TableHeaderColumn>Problem</TableHeaderColumn>
                        <TableHeaderColumn>Date</TableHeaderColumn>
                        <TableHeaderColumn>Handled</TableHeaderColumn>
                        <TableHeaderColumn>Technician assigned</TableHeaderColumn>
                    </TableRow>
                </TableHeader>
                <TableBody deselectOnClickaway={false}>
                    {rows}
                </TableBody>
            </Table>
        )
    }
}

IssuesTable.propTypes = {
    'entries': PropTypes.array.isRequired
};

const mapDispatchToProps = (dispath, ownProps) => {
    return {
        changeSelected: (selectedRow) => {
            dispath({type: 'SET_SELECTED', payload: selectedRow});
        }
    }
};

export default connect(undefined, mapDispatchToProps)(IssuesTable);