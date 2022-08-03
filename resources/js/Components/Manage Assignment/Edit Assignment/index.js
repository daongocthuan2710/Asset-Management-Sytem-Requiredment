/* eslint-disable react/display-name */
import React, { useState, forwardRef } from "react";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import Dropdown from 'react-bootstrap/Dropdown';
import { Row, Container, Col, div } from "reactstrap";
import { useSelector, useDispatch } from "react-redux";
import AssignmentService from "../../../Services/assignment.service";
import { getAssignmentEdit } from "../../../Actions/assignment.action";
import assignmentEditReducer from "../../../Reducers/assignment.reducer";
import { FaSearch } from "react-icons/fa";
import { FormControl, Modal } from "react-bootstrap";

export default function EditAssignmentForm() {
    const [showModal, setShowModal] = useState(false);
    const [modalHeader, setModalHeader] = useState("");
    const [modalBody, setModalBody] = useState("");
    const [disableSave, setDisableSave] = useState(true);

    const assignmentEditInfo = useSelector(
        (state) => state.assignmentEditReducer.assignmentEditInfo
    );

    const dispatch = useDispatch();
    function handleCloseEditForm(e) {
        e.preventDefault();
        const data = {
            assignmentId: "",
            displayValue: false,
            sort_at: "",
        };
        dispatch(getAssignmentEdit(data));
    }

    async function handleUpdateAssignmentInfo(e) {
        e.preventDefault();
        const data = {
            assignmentId: assignmentEditInfo.id || '',
            user: e.target.form[0].checked ? 1 : 0,
            assignment: e.target.form[2].value || '',
            note: e.target.form[3].value || '',
        };
        const response = await AssignmentService.updateAssignmentInfo(data);

        const message =
            response.data == undefined
                ? response.message
                : response.data.message;
        const code = response.code;
        handleShowMessage(code, message, assignmentEditInfo.id);
    }

    function handleShowMessage(code, message, assignmentId) {
        console.log(code, message, assignmentId);
        setShowModal(true);
        switch (code) {
            case 200:
                {
                    setModalHeader("Success");
                    setModalBody(message);
                    setTimeout(() => {
                        const data = {
                            assignmentId: assignmentId,
                            displayValue: false,
                            sort_at: "sortByEditAssignment",
                        };
                        dispatch(getAssignmentEdit(data));
                    }, 1500);
                }
                break;
            case 422:
                setModalHeader("Failed!");
                setModalBody(message);
                setTimeout(() => {
                    setShowModal(false);
                }, 1500);
                break;
        }
    }

    const CustomToggle = React.forwardRef(({ children, onClick }, ref) => (
        <div
          ref={ref}
          className = "d-flex justify-content-between"
          style = {{cursor: "pointer"}}
          onClick={(e) => {
            e.preventDefault();
            onClick(e);
          }}
        >
          <div>{children}</div>
          <div>&#x25bc;</div>
        </div>
      ));
                {/* <form className="search d-flex justify-content-between">
                    <input type="text" placeholder="Search.." name="search"/>
                    <div type="text"><FaSearch/></div>
                </form> */}
                {/* <div className = "d-flex justify-content-between">
                <Form.Control
                    autoFocus
                    className="mx-3 my-2 w-auto"
                    onChange={(e) => setValue(e.target.value)}
                    value={value}
                    />
                    <div id="search-icon"><FaSearch/></div>
                </div> */}

      const CustomMenu = React.forwardRef(
        ({ children, style, className, 'aria-labelledby': labeledBy }, ref) => {
          const [value, setValue] = useState('');
          return (
            <div
              ref={ref}
              style={style}
              className={className}
              aria-labelledby={labeledBy}
            >
            <Container className="w-auto">
                <Row>
                    <Col md={4}>Select User</Col>
                    <Col md={8}>
                        <Form.Control
                        autoFocus
                        className="mx-3 my-2 w-auto"
                        onChange={(e) => setValue(e.target.value)}
                        value={value}
                        />
                    </Col>
                </Row>
                <Row>
                    <ul className="list-unstyled">
                    {React.Children.toArray(children).filter(
                    (child) =>
                        !value || child.props.children.toLowerCase().startsWith(value),
                    )}
                    </ul>
                </Row>
                <Row>
                    <Col>Save</Col>
                    <Col>Cancel</Col>
                </Row>
            </Container>
            </div>
          );
        },
      );

    function handleShowButtonSave() {
        setDisableSave(false);
    }
    return (
        <>
            <Container id="containerFormEdit">
                <Row className="mb-3">
                    <Col md={5} className="editUser fs-4 mx-3">
                        Edit Assignment
                    </Col>
                    <Col md={7}></Col>
                </Row>
                <Row>
                    <Form
                        className="fs-5"
                        onChange={() => handleShowButtonSave()}
                    >
                        <Form.Group className="mb-3" controlId="UserSelectForm">
                            <Row>
                                <Col md={5}>
                                    <Form.Label className="mx-4">
                                        User
                                    </Form.Label>
                                </Col>
                                <Col md={7}>
                                    <Dropdown className="fs-5 form-control w-auto">
                                        <Dropdown.Toggle as={CustomToggle} id="dropdown-custom-components">
                                         User Name
                                        </Dropdown.Toggle>

                                        <Dropdown.Menu as={CustomMenu}>
                                        <Dropdown.Item eventKey="1">Red</Dropdown.Item>
                                        <Dropdown.Item eventKey="2">Blue</Dropdown.Item>
                                        <Dropdown.Item eventKey="3" active>
                                            Orange
                                        </Dropdown.Item>
                                        <Dropdown.Item eventKey="1">Red-Orange</Dropdown.Item>
                                        </Dropdown.Menu>
                                    </Dropdown>
                                </Col>
                            </Row>
                        </Form.Group>
                        <Form.Group className="mb-3" controlId="AssetSelectForm">
                            <Row>
                                <Col md={5}>
                                    <Form.Label className="mx-4">
                                        Asset
                                    </Form.Label>
                                </Col>
                                <Col md={7}>
                                    <Dropdown className="fs-5 form-control">
                                        <Dropdown.Toggle as={CustomToggle} id="dropdown-custom-components">
                                         Asset Name
                                        </Dropdown.Toggle>

                                        <Dropdown.Menu as={CustomMenu}>
                                        <Dropdown.Item eventKey="1">Red</Dropdown.Item>
                                        <Dropdown.Item eventKey="2">Blue</Dropdown.Item>
                                        <Dropdown.Item eventKey="3" active>
                                            Orange
                                        </Dropdown.Item>
                                        <Dropdown.Item eventKey="1">Red-Orange</Dropdown.Item>
                                        </Dropdown.Menu>
                                    </Dropdown>
                                </Col>
                            </Row>
                        </Form.Group>
                        <Form.Group
                            className="mb-3"
                            controlId="AssignedDateForm"
                        >
                            <Row>
                                <Col md={5}>
                                    <Form.Label className="mx-4">
                                        Assigned Date
                                    </Form.Label>
                                </Col>
                                <Col md={7}>
                                    <Form.Control
                                        type="date"
                                        value={
                                            assignmentEditInfo.installed_date || ""
                                        }
                                        placeholder="Due Join Date"
                                        className="fs-5"
                                    ></Form.Control>
                                </Col>
                            </Row>
                        </Form.Group>
                        <Form.Group
                            className="mb-3"
                            controlId="NoteForm"
                        >
                            <Row>
                                <Col md={5}>
                                    <Form.Label className="mx-4">
                                        Note
                                    </Form.Label>
                                </Col>
                                <Col md={7}>
                                    <Form.Control
                                        as="textarea"
                                        rows={3}
                                        defaultValue={''}
                                        className="fs-5"
                                    />
                                </Col>
                            </Row>
                        </Form.Group>


                        <Row className="text-end">
                            <Col>
                                <Button
                                    id="pwSaveButton"
                                    variant="light"
                                    onClick={handleUpdateAssignmentInfo}
                                    disabled={disableSave}
                                >
                                    Save
                                </Button>
                                <b> </b>
                                <Button
                                    id="pwCancelButton"
                                    variant="light"
                                    onClick={handleCloseEditForm}
                                >
                                    Cancel
                                </Button>
                            </Col>
                        </Row>
                    </Form>
                </Row>
            </Container>
            <Modal show={showModal} backdrop="static" keyboard={false}>
                <Modal.Header>
                    <Modal.Title id="pwChangePasswordHeader">
                        {modalHeader}
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Container id="pwChangePasswordFirstContainer">
                        <Row>
                            <p id="successAlert">{modalBody}</p>
                        </Row>
                    </Container>
                </Modal.Body>
            </Modal>
        </>
    );
}
