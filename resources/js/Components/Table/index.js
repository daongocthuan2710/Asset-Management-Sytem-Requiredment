import React, { useMemo } from "react";
import { useTable, useSortBy } from "react-table";
import './style.scss';
import './style.css';
import { FaAngleDown, FaAngleUp } from "react-icons/fa";
export const HomeTable = () => {
    // const data = useSelector(state => state.homeReducer.userList)
    // const columns = useMemo(() => COLUMNS, [])


    const dataJson = [
        {
            asset_code: 'LA100002',
            asset_name: 'Laptop HP Probook 450 G1',
            category: 'Laptop',
            assigned_date: '10/04/2019',
            state: 'Accepted'
        },
        {
            asset_code: 'LA100002',
            asset_name: 'Laptop HP Probook 450 G1',
            category: 'Laptop',
            assigned_date: '10/04/2019',
            state: 'Accepted'
        },
        {
            asset_code: 'MO100004',
            asset_name: 'Monitor Dell UltraSharp',
            category: 'Monitor',
            assigned_date: '20/03/2021',
            state: 'Waiting for acceptance'
        }
    ]
    const columnsJson = [
        {
            Header: 'Asset Code',
            accessor: 'asset_code'
        },
        {
            Header: 'Asset Name',
            accessor: 'asset_name'
        },
        {
            Header: 'Category',
            accessor: 'category'
        },
        {
            Header: 'Assigned date',
            accessor: 'assigned_date'
        },
        {
            Header: 'State',
            accessor: 'state'
        }
    ]
    const columns = useMemo(() => columnsJson, [])
    const data = useMemo(() => dataJson, [])

    // useEffect(() => { })
    // const tableInstance = useTable({
    //     columns,
    //     data
    // }, useSortBy)
    // const {
    //     getTableProps, getTableBodyProps, headerGroups, rows, prepareRow,

    // } = tableInstance
    // // console.log(columns);

    const { getTableProps, getTableBodyProps, headerGroups, rows, prepareRow, } = useTable({
        columns, data
    }, useSortBy)


    return (

        <div className="table-content">
            <table {...getTableProps()}>
                <thead>
                    {headerGroups.map((headerGroup) => (
                        // eslint-disable-next-line react/jsx-key
                        <tr {...headerGroup.getHeaderGroupProps()} >
                            {
                                headerGroup.headers.map((column) => (
                                    // eslint-disable-next-line react/jsx-key
                                    <th {...column.getHeaderProps(column.getSortByToggleProps())}>
                                        {column.render('Header')}
                                        <span>
                                            {column.isSorted ? (column.isSortedDesc ? <FaAngleDown /> : <FaAngleUp />) : ''}
                                        </span>
                                    </th>
                                ))
                            }
                        </tr>
                    ))}
                </thead>
                <tbody {...getTableBodyProps()}>
                    {
                        rows.map(row => {
                            prepareRow(row)
                            return (
                                // eslint-disable-next-line react/jsx-key
                                <tr {...row.getRowProps()}>
                                    {
                                        row.cells.map((cell) => {
                                            // eslint-disable-next-line react/jsx-key
                                            return <td {...cell.getCellProps()}>{cell.render('Cell')}</td>
                                        })
                                    }
                                </tr>
                            )
                        })
                    }
                </tbody>
            </table>
        </div>
    )
}
