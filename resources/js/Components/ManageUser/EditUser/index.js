import React, { useState } from "react";
import "./style.scss";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import { Row, Container, Col } from "reactstrap";

export default function EditForm() {
    const [date, setDate] = useState("1966-11-10");
    const [joinDate, setJoinDate] = useState("2019-04-09");
    return (
        <Container>
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
                                <Form.Control type="input" placeholder="An" disabled/>
                                {/* <Form.Text className="text-muted">
                            { We'll never share your email with anyone else. }
                        </Form.Text> */}
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
                                    placeholder="Tran Van"
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
                            <Col md={10} style = {{display:"inherit"}}>
                                {["Female", "Male"].map((labelName) => (
                                    <div key={labelName} className="mb-3">
                                        <Form.Check inline>
                                            <Form.Check.Input
                                                type="radio"
                                                id="Female"
                                                name="groupGender"
                                                isInvalid
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
                                <Form.Control as="select" defaultValue="Staff">
                                    <option>Staff</option>
                                    <option>Amir Conley</option>
                                    <option>Barney Hirst</option>
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
                            <Button variant="outline-secondary" type="submit">
                                Cancel
                            </Button>
                        </Col>
                    </Row>
                </Form>
            </Row>
        </Container>
    );
}
