import React from "react";
import "./style.scss";
import "./style.css";
import Table from "react-bootstrap/Table";
import { FaAngleDown, FaPencilAlt, FaRegTimesCircle, FaFilter, FaSearch } from "react-icons/fa";
import Pagination from "react-js-pagination";
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Dropdown from 'react-bootstrap/Dropdown';
import DropdownButton from 'react-bootstrap/DropdownButton';
import Form from 'react-bootstrap/Form';
import InputGroup from 'react-bootstrap/InputGroup';
import { Button } from "react-bootstrap";

export const ManageUser = () => {
  return (
    <Container> 
       <h5 style={{color:"red", fontWeight:"bold"}}>User List </h5>
       <Row>
       <Col xs={4} md={2}>
       <InputGroup className="mb-1">
        <Form.Control placeholder="Type" aria-label="Text input with dropdown button"  />

        <DropdownButton className="btn-filter"
          variant="outline-secondary"
          title={  <span>
            <FaFilter />
        </span>}   
          id="input-group-dropdown-2"
          align="end"
        >
          <Dropdown.Item href="#">Action</Dropdown.Item>
          <Dropdown.Item href="#">Another action</Dropdown.Item>
          <Dropdown.Item href="#">Something else here</Dropdown.Item>
          <Dropdown.Divider />
          <Dropdown.Item href="#">Separated link</Dropdown.Item>
        </DropdownButton>
      </InputGroup>
        </Col>

        <Col xs={8} md={10}>
          <Row>
            <Col xs={4} md={4}>
            <InputGroup className="mb-1">
        <Form.Control placeholder="Search" aria-label="Text input with dropdown button"  />
        <InputGroup.Text id="basic-addon2"> <FaSearch/></InputGroup.Text>
   
        
        </InputGroup>
            </Col>
            <Col xs={8} md={8}>
            <Button className="btn-createnewuser">
              Create new user
            </Button>
            </Col>
          </Row>

        </Col>
    
      </Row>
     <Row>
   
        <Col xl={12} >
      <Table responsive="md" >
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
            <td>An Nguyen Thuy</td>
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
            <td>An Nguyen Thuy</td>
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
            <td>An Nguyen Thuy</td>
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
            <td>An Nguyen Thuy</td>
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
            <td>An Nguyen Thuy</td>
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
            <td>An Nguyen Thuy</td>
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
            <td>An Nguyen Thuy</td>
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

</Col>
</Row>
    </Container>
  );
};
