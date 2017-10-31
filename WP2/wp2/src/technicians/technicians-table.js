/**
 * Created by Spape on 27/10/2017.
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

class TechniciansTable extends Component {
    render() {
        const rows = this.props.entries.map(e => (
            <TableRow key={e.id}>
                <TableRowColumn>{e.email}</TableRowColumn>
                <TableRowColumn>{e.name}</TableRowColumn>
            </TableRow>
        ));
        return (
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHeaderColumn>Email</TableHeaderColumn>
                        <TableHeaderColumn>Name</TableHeaderColumn>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    {rows}
                </TableBody>
            </Table>
        )
    }
}

TechniciansTable.propTypes = {
    'entries': PropTypes.array.isRequired
}

export default TechniciansTable;