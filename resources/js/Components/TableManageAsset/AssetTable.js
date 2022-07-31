import Table from "react-bootstrap/Table";
import {
    FaAngleDown,
    FaAngleUp,
    FaPencilAlt,
    FaRegTimesCircle,
} from "react-icons/fa"
export default function AssetTable({
    data, Nodata, tableHeader,
    handleSort, handleOpenEditForm,
    handleGetUserById, handleDisableUser
}) {
    return (
        <Table responsive="md">
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
                        : ""}
                </tr>
            </thead>
            <tbody>
                {data.length > 0 ? (
                    data.length > 0 &&
                    data.map((item) => (
                        <tr key={item.id} onClick={() => handleGetUserById(item.id)}>
                            <td>{item.asset_code}</td>
                            <td>{item.name}</td>
                            <td>{item.category.name}</td>
                            <td>{item.state.name}</td>
                            <td className="td-without_border">
                                <FaPencilAlt
                                    onClick={(e) => handleOpenEditForm(e, item.id)} id='editUserButton'
                                />{" "}
                                {"  "}
                                <FaRegTimesCircle className="delete-icon" onClick={(e) => handleDisableUser(e, item.id)} type="button" />
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