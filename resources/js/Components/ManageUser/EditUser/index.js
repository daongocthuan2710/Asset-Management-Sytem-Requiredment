import React, { useState } from "react";
import "./style.scss";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import { Row, Container, Col } from "reactstrap";
import { useSelector, useDispatch } from "react-redux";
import userEditReducer from "../../../Reducers/userEdit.reducer";
import { getUserEdit } from "../../../Actions/user.action";
export default function EditForm() {
    const userEditInfo = useSelector(
        (state) => state.userEditReducer.userEditInfo
    );
    const [date, setDate] = useState(userEditInfo.date_of_birth);
    const [joinDate, setJoinDate] = useState(userEditInfo.joined_date);
    const [selectedRadio, setSelectedRadio] = useState(
        userEditInfo.gender ? "Male" : "Female"
    );
    const type = userEditInfo.type ? "Admin" : "Staff";

    const dispatch = useDispatch();
    function handleCloseEditForm(e) {
        e.preventDefault();
        const userId = 1;
        const displayValue = false;
        dispatch(getUserEdit(displayValue, userId));
    }
    return (
        <Container id = "containerFormEdit">
            <Row className="mb-3">
                <Col md={2} className="editUser fs-4 d-flex justify-content-end">
                    Edit User
                </Col>
                <Col md={10}></Col>
            </Row>
            <Row>
                <Form className = "fs-5">
                    <Form.Group className="mb-3" controlId="firstNameForm">
                        <Row>
                            <Col md={2} className = "d-flex justify-content-end">
                                <Form.Label>First Name</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="input"
                                    value={userEditInfo.first_name}
                                    disabled
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="lastNameForm">
                        <Row>
                            <Col md={2} className = "d-flex justify-content-end">
                                <Form.Label>Last Name</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="text"
                                    className = "fs-5"
                                    value={userEditInfo.last_name}
                                    disabled
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="dueDateForm">
                        <Row>
                            <Col md={2} className = "d-flex justify-content-end">
                                <Form.Label>Date of Birth</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="date"
                                    value={date}
                                    placeholder="Due Date"
                                    className = "fs-5"
                                    onChange={(e) => setDate(e.target.value)}
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="genderForm">
                        <Row>
                            <Col md={2} className = "d-flex justify-content-end">
                                <Form.Label>Gender</Form.Label>
                            </Col>
                            <Col md={10} style={{ display: "inherit" }}>
                                {["Female", "Male"].map((labelName) => (
                                    <div key={labelName} className="mb-3">
                                        <Form.Check inline>
                                            <Form.Check.Input
                                                type="radio"
                                                id="Female"
                                                className = "fs-5"
                                                checked={
                                                    selectedRadio == labelName
                                                }
                                                name="groupGender"
                                                isInvalid={
                                                    selectedRadio == labelName
                                                }
                                                onChange={(e) =>
                                                    setSelectedRadio(labelName)
                                                }
                                            />
                                            <Form.Check.Label
                                                style={{ color: "black" }}
                                            >
                                                {labelName}
                                            </Form.Check.Label>
                                        </Form.Check>
                                    </div>
                                ))}
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="dueJoinDateForm">
                        <Row>
                            <Col md={2} className = "d-flex justify-content-end">
                                <Form.Label>Joined Date</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="date"
                                    value={joinDate}
                                    placeholder="Due Join Date"
                                    className = "fs-5"
                                    onChange={(e) =>
                                        setJoinDate(e.target.value)
                                    }
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="TypeForm">
                        <Row>
                            <Col md={2} className = "d-flex justify-content-end">
                                <Form.Label>Type</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control as="select" defaultValue={type} className = "fs-5">
                                    <option>Staff</option>
                                    <option>Admin</option>
                                </Form.Control>
                            </Col>
                        </Row>
                    </Form.Group>
                    <Row className="text-end">
                        <Col>
                            <Button
                                className="me-5 fs-5"
                                variant="danger"
                                type="submit"
                            >
                                Submit
                            </Button>
                            <Button
                            className="fs-5"
                                variant="outline-secondary"
                                onClick={handleCloseEditForm}
                            >
                                Cancel
                            </Button>
                        </Col>
                    </Row>
                </Form>
            </Row>
        </Container>
    );
}
