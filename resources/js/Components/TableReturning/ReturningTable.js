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
    FaCheck,
    FaTimes

} from "react-icons/fa";
import moment from "moment";
import { Redirect , Navigate} from "react-router-dom";

export default function ReturningTable({
    data, Nodata, tableHeader,
    // eslint-disable-next-line no-unused-vars
    handleSort, handleOpenEditForm,
    handleGetAssignmentById, handleDeleteAssignment
}) {
    let history = useHistory();

    async function handleOpenEditAssetForm(e, assignmentId = "") {
      e.stopPropagation();
        const response = await AssignmentService.getAssignmentEdit(assignmentId);
      handleShowMessage(response,assignmentId);
    }

    function handleShowMessage(response,assignmentId) {
        const message = response.data == undefined ? response.message : response.data.message;
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
                            <FaCheck id="fa-check"/>
                            &nbsp;
                            <FaTimes  id="deleteIcon"/>

                             </td>
                        </tr>
                    ))
                ) : (
                    <img id="img-nodata" style={{marginLeft : 370}} src={Nodata}></img>
                )}
            </tbody>
        </Table>
    );
}
