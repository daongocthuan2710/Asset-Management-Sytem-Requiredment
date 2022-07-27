import React from "react";
import "./style.scss";
import "./style.css";
import Table from "react-bootstrap/Table";
import {
  FaAngleDown,
  FaPencilAlt,
  FaRegTimesCircle,
  FaFilter,
  FaSearch,
} from "react-icons/fa";
import Pagination from "react-js-pagination";
// import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Dropdown from "react-bootstrap/Dropdown";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import { Button } from "react-bootstrap";
import { getUserEdit } from '../../Actions/user.action';
import {useDispatch } from "react-redux";

export const ManageUser = () => {
  const [currentButton, setFilter] = React.useState("");
  const dispatch = useDispatch();

  function handleOpenEditForm(userId = ''){
    const displayValue = true;
    dispatch(getUserEdit(displayValue,userId));
  }

  return (
    <div className="containermanageuser">
      <h5 style={{ color: "red", fontWeight: "bold" }}>User List </h5>
      <div className="d-flex justify-content-between type-seach-create">

          <Dropdown>
            <Dropdown.Toggle className="filter-button d-flex align-items-center justity-content-center">
              <p className="flex-grow-1 font-weight-bold mb-0">Type</p>
              <div className="fb-icon">
                <FaFilter />
              </div>
            </Dropdown.Toggle>
            <Dropdown.Menu>
              <Form>
                <Form.Check
                  type="checkbox"
                  id="checkbox-all"
                  className="mx-4 font-weight-bold"
                  label="All"
                  checked={currentButton === "All"}
                  onChange={() => setFilter("All")}
                />
                <Form.Check
                  type="checkbox"
                  id="checkbox-admin"
                  className="mx-4 my-2 font-weight-bold"
                  label="Admin"
                  checked={currentButton === "Admin"}
                  onChange={() => setFilter("Admin")}
                />
                <Form.Check
                  type="checkbox"
                  id="checkbox-staff"
                  className="mx-4 font-weight-bold"
                  label="Staff"
                  checked={currentButton === "Staff"}
                  onChange={() => setFilter("Staff")}
                />
              </Form>
            </Dropdown.Menu>
          </Dropdown>

            <div className="d-flex search-create">

              <InputGroup className="search-bar mb-1">
                <Form.Control
                  placeholder="Search"
                  aria-label="Text input with dropdown button"
                />
                <InputGroup.Text id="basic-addon2">
                  {" "}
                  <FaSearch />
                </InputGroup.Text>
              </InputGroup>

              <Button id="btn-createnewuser" className="btn-createnewuser">Create new user</Button>
              </div>
      </div>
      <Row>

          <Table responsive="md">
            <thead>
              <tr>
                <th>
                  Staff Code <FaAngleDown />
                </th>
                <th>
                  Fullname <FaAngleDown />
                </th>
                <th>
                  Username <FaAngleDown />
                </th>
                <th>
                  Joined Date <FaAngleDown />
                </th>
                <th>
                  Type <FaAngleDown />
                </th>
              </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>SD1901</td>
                        <td>Dao Ngoc Thuan</td>
                        <td>annt</td>
                        <td>20/06/2019</td>
                        <td>Staff</td>
                        <td className="td-without_border">
                          <div onClick = {(e) => handleOpenEditForm(5)}><FaPencilAlt /></div> {"  "}
                          <FaRegTimesCircle className="delete-icon" />
                        </td>
                      </tr>
                      <tr>
                        <td>SD1901</td>
                        <td>Dao Ngoc Thuan</td>
                        <td>annt</td>
                        <td>20/06/2019</td>
                        <td>Staff</td>
                        <td className="td-without_border">
                          <FaPencilAlt /> {"  "}
                          <FaRegTimesCircle className="delete-icon" />
                        </td>
                      </tr>
                      <tr>
                        <td>SD1901</td>
                        <td>Dao Ngoc Thuan</td>
                        <td>annt</td>
                        <td>20/06/2019</td>
                        <td>Staff</td>
                        <td className="td-without_border">
                          <FaPencilAlt /> {"  "}
                          <FaRegTimesCircle className="delete-icon" />
                        </td>
                      </tr>
            </tbody>
          </Table>
          <Pagination
            activePage={1}
            itemsCountPerPage={3}
            totalItemsCount={15}
            pageRangeDisplayed={3}
            prevPageText="Previous"
            nextPageText="Next"
            itemClass="page-item"
            linkClass="page-link"
            linkClassPrev="page-prev"
            linkClassNext="page-next"
            activeLinkClass="pagination-active"
            hideFirstLastPages={true}
          />

      </Row>
    </div>
  );

};

