import React, { useState } from "react";
import "./style.scss";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import { Row, Container, Col } from "reactstrap";
import { useSelector, useDispatch } from "react-redux";
import { getUserEdit } from "../../../Actions/user.action";

export default function EditForm() {
    const userEditInfo = useSelector(state => state.userEditReducer.userEditInfo);
    const [date, setDate] = useState(userEditInfo.date_of_birth);
    const [joinDate, setJoinDate] = useState(userEditInfo.joined_date);
    const [selectedRadio, setSelectedRadio] = useState(userEditInfo.gender ? 'Male' : 'Female');
    const type = (userEditInfo.type) ? 'Admin' : 'Staff';

    const dispatch = useDispatch();
    function handleCloseEditForm(e) {
        e.preventDefault();
        const userId = null;
        const displayValue = false;
        dispatch(getUserEdit(displayValue, userId));
    }
    return (
        <Container style = {{width: "100% !impotant" }}>
            <Row className="mb-3">
                <Col md={12} className="editUser">
                    Edit User
                </Col>
            </Row>
            <Row>
                <Form>
                    <Form.Group className="mb-3" controlId="firstNameForm">
                        <Row>
                            <Col md={2}>
                                <Form.Label>First Name</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="input"
                                    value = {userEditInfo.first_name}
                                    disabled
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="lastNameForm">
                        <Row>
                            <Col md={2}>
                                <Form.Label>Last Name</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="text"
                                    value = {userEditInfo.last_name}
                                    disabled
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="dueDateForm">
                        <Row>
                            <Col md={2}>
                                <Form.Label>Date of Birth</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="date"
                                    value={date}
                                    placeholder="Due Date"
                                    onChange={(e) => setDate(e.target.value)}
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="genderForm">
                        <Row>
                            <Col md={2}>
                                <Form.Label>Gender</Form.Label>
                            </Col>
                            <Col md={10} style={{ display: "inherit" }}>
                                {["Female", "Male"].map((labelName) => (
                                    <div key={labelName} className="mb-3">
                                        <Form.Check inline>
                                            <Form.Check.Input
                                                type="radio"
                                                id="Female"
                                                checked = {selectedRadio == labelName}
                                                name="groupGender"
                                                isInvalid = {selectedRadio == labelName}
                                                onChange = {(e)=>setSelectedRadio(labelName)}
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
                            <Col md={2}>
                                <Form.Label>Joined Date</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="date"
                                    value={joinDate}
                                    placeholder="Due Join Date"
                                    onChange={(e) =>
                                        setJoinDate(e.target.value)
                                    }
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="TypeForm">
                        <Row>
                            <Col md={2}>
                                <Form.Label>Type</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control as="select" defaultValue={type}>
                                    <option>Staff</option>
                                    <option>Admin</option>
                                </Form.Control>
                            </Col>
                        </Row>
                    </Form.Group>
                    <Row className="text-end">
                        <Col>
                            <Button
                                className="me-5"
                                variant="danger"
                                type="submit"
                            >
                                Submit
                            </Button>
                            <Button
                                variant="outline-secondary"
                                onClick={handleCloseEditForm}
                                // type="submit"
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
