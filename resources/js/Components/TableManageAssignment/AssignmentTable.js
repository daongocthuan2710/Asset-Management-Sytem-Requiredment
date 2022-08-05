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
import { Redirect , Navigate} from "react-router-dom";

export default function AssignmentTable({
    data, Nodata, tableHeader,
    handleSort, handleOpenEditForm,
    handleGetUserById, handleDeleteAsset
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
                        <tr key={item.id} onClick={() => handleGetUserById(item.id)}>
                            <td>{item.id}</td>
                            <td>{item.asset.asset_code}</td>
                            <td>{item.asset.name}</td>
                            <td>{item.staff.username}</td>
                            <td>{item.assigned_by.username}</td>
                            <td>{moment(item.assigned_date).format('DD-MM-YYYY')}</td>
                            <td>{item.state.name}</td>

                            <td className="td-without_border">
                                        <FaPencilAlt
                                            onClick={(e) => handleOpenEditAssetForm(e, item.id)} aria-disabled={item.state.code !== 2 } id='editUserButton'
                                        />
                                        {" "}
                                        {"  "}
                                        &nbsp;
                                        <FaRegTimesCircle className="delete-icon" aria-disabled={item.state.code !== 2 }
                                                          onClick={(e) => handleDeleteAsset(e, item.id)} type="button"/>
                                                          {" "}
                                        {"" } &nbsp;
                                        <FaUndo id="undo-icon"/>
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
