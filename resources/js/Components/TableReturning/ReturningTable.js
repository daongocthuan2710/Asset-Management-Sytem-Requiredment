/* eslint-disable react/prop-types */
import React, {useState} from "react";
import Table from "react-bootstrap/Table";

import {
    FaAngleDown,
    FaAngleUp,
    FaCheck,
    FaTimes

} from "react-icons/fa";
import moment from "moment";
import CompleteReturningRequest from "../CompleteReturningRequestModal";

export default function ReturningTable({
    data, Nodata, tableHeader,
    // eslint-disable-next-line no-unused-vars
    handleSort,
    handleGetAssignmentById
}) {
    const [show, setShow] = useState(false);
    const [returningId, setRreturningId] = useState('');
    async function handleShowModalCompleteReturning(returningId) {
        setShow(true);
        setRreturningId(returningId);
    }


    return (
        <>
        <Table id="table-assignment" responsive="md">
            <thead>
                <tr>
                    {data.length > 0
                        ? tableHeader.map((item, index) => {
                            return (
                                <th
                                    key={index}
                                    onClick={() => {
                                        if (item.name !== "Username") {
                                            handleSort(item.name, item.isSortASC);
                                        }
                                    }}
                                >
                                    {item.name}&nbsp;
                                    {item.isSortASC && <FaAngleDown />}
                                    {item.isSortDESC && <FaAngleUp />}
                                </th>
                            );
                        })
                        :''}
                </tr>
            </thead>
            <tbody>
                {data.length > 0 ? (
                    data.length > 0 &&
                    data.map((item) => (
                        <tr key={item.id} onClick={() => handleGetAssignmentById(item.id)}>
                            <td>{item.id}</td>
                            <td>{item.assignment.asset.asset_code}</td>
                            <td >{item.assignment.asset.name}</td>
                            <td>{item.requested_by.username}</td>

                            <td>{moment(item.assignment.assigned_date).format('DD-MM-YYYY')}</td>
                            <td>{item.accepted_by.username}</td>
                            <td>{moment(item.return_date).format('DD-MM-YYYY')}</td>
                            <td>{item.returning_state}</td>

                            <td className="td-without_border">
                            {
                                item.returning_state == "Waiting for returning" ?
                                    <>
                                        <FaCheck onClick={() => handleShowModalCompleteReturning(item.id)} id='editUserButton' />
                                        &nbsp;
                                        <FaTimes/>
                                    </>
                                :   <>
                                    <FaCheck color='gray'/>
                                    &nbsp;
                                    <FaTimes color='gray'/>
                                </>

                            }
                             </td>
                        </tr>
                    ))
                ) : (
                    <img id="img-nodata" src={Nodata}></img>
                )}
            </tbody>
        </Table>
        <CompleteReturningRequest show = {show} returningId = {returningId}/>
    </>
    );
}
