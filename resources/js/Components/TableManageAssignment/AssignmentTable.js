/* eslint-disable react/prop-types */
import React from "react";
import Table from "react-bootstrap/Table";
import { getAssetEdit } from "../../Actions/asset.action";
import { useDispatch,useSelector } from "react-redux";
import assetEditReducer from "../../Reducers/asset.reducer";
import Swal from "sweetalert2";
import {
    FaAngleDown,
    FaAngleUp,
    FaPencilAlt,
    FaRegTimesCircle,
    FaUndo
} from "react-icons/fa";
import moment from "moment";

export default function AssignmentTable({
    data, Nodata, tableHeader,
    // eslint-disable-next-line no-unused-vars
    handleSort, handleOpenEditForm,
    handleGetAssignmentById, handleDeleteAssignment
}) {
    const sort_at = useSelector(
        (state) => state.assetEditReducer.sort_at
      );
    //   console.log('sort_at',sort_at);
    //   if(sort_at === 'sortByEditAsset'){
    //     array.push('sortByEditUser');

    //   }
    //   if(sort_at ===  'sortByCreateAsset'){
    //     array.push('sortByCreateUser');
    //   }

    const dispatch = useDispatch();
    async function handleOpenEditAssetForm(e, assetId = "") {
      e.stopPropagation();
      const data = {
        assetId: assetId,
        displayValue: true,
        sort_at:''
    }
      const response = await dispatch(getAssetEdit(data));
      handleShowMessage(response);
    }

    function handleShowMessage(response) {
        const message = response.data == undefined ? response.message : response.data.message;
        const code = response.code;
        switch (code) {
          case 200:
            {
              //
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
                            <td>{item.asset.asset_code}</td>
                            <td>{item.asset.name}</td>
                            <td>{item.staff.username}</td>
                            <td>{item.assigned_by.username}</td>
                            <td>{moment(item.assigned_date).format('DD-MM-YYYY')}</td>
                            <td>{item.state.name}</td>

                            <td className="td-without_border">
                                     <FaPencilAlt
                                            onClick={(e) => handleOpenEditAssetForm(e, item.id)} aria-disabled={item.state.code !== 2 } id='editUserButton'
                                        />{" "}
                                        {"  "}
                                        &nbsp;
                                {
                                    item.state.code === 1 ?
                                        <FaRegTimesCircle color='gray'/>
                                        : <FaRegTimesCircle className="delete-icon" aria-disabled={item.state.code !== 2 }
                                                            onClick={(e) => handleDeleteAssignment(e, item.id)} type="button"/>
                                }
                                {" "}{" "} &nbsp;
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
