/**
 * Created by Spape on 21/10/2017.
 */
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

class IssuesTable extends Component {
    handleRowSelection = (selectedRows) => {
      const selectedRow = this.props.entries[selectedRows].id;
      this.props.changeSelected(selectedRow);
    };

    render() {
        const rows = this.props.entries.map(e => (
            <TableRow key={e.id}>
                <TableRowColumn>{e.problem}</TableRowColumn>
                <TableRowColumn>{e.date}</TableRowColumn>
                <TableRowColumn>{e.handled}</TableRowColumn>
            </TableRow>
        ));
        return (
            <Table onRowSelection={this.handleRowSelection}>
                <TableHeader>
                    <TableRow>
                        <TableHeaderColumn>Problem</TableHeaderColumn>
                        <TableHeaderColumn>Date</TableHeaderColumn>
                        <TableHeaderColumn>Handled</TableHeaderColumn>
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
            dispath({type: 'SET_SELECTION', payload: selectedRow});
        }
    }
};

export default connect(undefined, mapDispatchToProps)(IssuesTable);