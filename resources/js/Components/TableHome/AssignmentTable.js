/* eslint-disable react/prop-types */
import React from "react";
import Table from "react-bootstrap/Table";
import { getAssignmentEdit } from "../../Actions/assignment.action";
import assetEditReducer from "../../Reducers/asset.reducer";
import AssignmentService from "../../Services/assignment.service";
import Swal from "sweetalert2";
import { useHistory } from "react-router-dom";
import {
    FaAngleDown,
    FaAngleUp,
    FaPencilAlt,
    FaRegTimesCircle,
    FaUndo
} from "react-icons/fa";
import moment from "moment";
import { Redirect, Navigate } from "react-router-dom";

export default function AssignmentTable({
    data, Nodata, tableHeader,
    // eslint-disable-next-line no-unused-vars
    handleSort, handleOpenEditForm,handleCreateReturn,
    handleGetAssignmentById, handleDeleteAssignment
}) {
    let history = useHistory();

    async function handleOpenEditAssetForm(e, assignmentId = "") {
        e.stopPropagation();
        const response = await AssignmentService.getAssignmentEdit(assignmentId);
        handleShowMessage(response, assignmentId);
    }

    console.log(data)
    function handleShowMessage(response, assignmentId) {
        const message = response.data === undefined ? response.message : response.data.message;
        const code = response.code;
        switch (code) {
            case 200:
                {
                    history.push(`/edit-assignment/${assignmentId}`);
                }
                break;
            case 422:
                {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
                break;
            case 401:
                {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
                break;
        }

    }
    return (
        <Table id="table-assignment" responsive="md">
            <thead>
                <tr>
                    {data.length > 0
                        ? tableHeader.map((item, index) => {
                            return (
                                <th
                                    key={index}
                                    onClick={() => {
                                        handleSort(item.name, item.isSortASC);
                                    }}
                                >
                                    {item.name}&nbsp;
                                    {item.isSortASC && <FaAngleDown />}
                                    {item.isSortDESC && <FaAngleUp />}
                                </th>
                            );
                        })
                        : ''}
                </tr>
            </thead>
            <tbody>
                {data.length > 0 ? (
                    data.length > 0 &&
                    data.map((item) => (
                        <tr key={item.id} onClick={() => handleGetAssignmentById(item.id)}>
                            <td>{item.id}</td>
                            <td>{item.asset.asset_code}</td>
                            <td ><p id="staff-asset-name">{item.asset.name}</p></td>
                            <td>{item.staff.username}</td>
                            <td>{item.assigned_by.username}</td>
                            <td>{moment(item.assigned_date).format('DD-MM-YYYY')}</td>
                            <td>{item.state.name}</td>

                            <td className="td-without_border">
                                {
                                    item.state.code === 0 ?
                                        <FaPencilAlt onClick={(e) => handleOpenEditAssetForm(e, item.id)} aria-disabled={item.state.code !== 2} id='editUserButton' />
                                        : <FaPencilAlt color='gray' />
                                }
                                {" "}
                                {"  "}
                                &nbsp;
                                {
                                    item.state.code === 1 ?
                                        <FaRegTimesCircle color='gray' />
                                        : <FaRegTimesCircle className="delete-icon" aria-disabled={item.state.code !== 2}
                                            onClick={(e) => handleDeleteAssignment(e, item.id)} type="button" />
                                }
                                {" "}{" "} &nbsp;
                                {/*<FaUndo id="undo-icon" onClick={(e) => handleCreateReturn(e, item.id)}/>*/}
                                {item.state.code === 2 ? <FaUndo color='gray' /> : <FaUndo id="undo-icon" onClick={(e) => handleCreateReturn(e, item.id)}/>}
                            </td>
                        </tr>
                    ))
                ) : (
                    <img id="img-nodata" src={Nodata}></img>
                )}
            </tbody>
        </Table>
    );
}
