import React, { useState } from "react";
import "./style.scss";
import "./toast.css";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import { Row, Container, Col } from "reactstrap";
import { useSelector, useDispatch } from "react-redux";
import userEditReducer from "../../../Reducers/userEdit.reducer";
import UserService from "../../../Services/user.service";
import { getUserEdit } from "../../../Actions/user.action";
import Swal from "sweetalert2";
export default function EditForm() {
    const userEditInfo = useSelector(
        (state) => state.userEditReducer.userEditInfo
    );
    const [date, setDate] = useState(userEditInfo.date_of_birth);
    const [joinDate, setJoinDate] = useState(userEditInfo.joined_date);
    const [selectedRadio, setSelectedRadio] = useState(
        userEditInfo.gender || userEditInfo.gender == null ? "Male" : "Female"
    );
    const type = userEditInfo.type ? "Admin" : "Staff";
    const dispatch = useDispatch();
    function handleCloseEditForm(e) {
        e.preventDefault();
        const userId = userEditInfo.id;
        const displayValue = false;
        dispatch(getUserEdit(displayValue, userId));
    }

    async function handleUpdateUserInfo(e) {
        e.preventDefault();
        const userId = userEditInfo.id;
        const date_of_birth = e.target.form[2].value;
        const gender = e.target.form[4].checked ? 1 : 0;
        const joined_date = e.target.form[5].value;
        const type = e.target.form[6].value === "Admin" ? 1 : 0;

        const response = await UserService.updateUserInfo(
            userId,
            date_of_birth,
            gender,
            joined_date,
            type
        );

        const message = response.data == undefined ? response.message : response.data.message;
        const code = response.code;
        handleShowMessage(code, message, userId);
    }

    async function handleShowMessage(code, message, userId) {
        switch (code) {
            case 200:
                {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(
                        () => {const displayValue = false;
                        dispatch(getUserEdit(displayValue, userId,'sortByEditUser'))},
                        1500);
                }
                break;
            case 422:
                {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: message,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                }
                break;
        }
    }

    return (
        <Container id="containerFormEdit">
            <Row className="mb-3">
                <Col
                    md={2}
                    className="editUser fs-4 mx-3"
                >
                    Edit User
                </Col>
                <Col md={10}></Col>
            </Row>
            <Row>
                <Form className="fs-5">
                    <Form.Group className="mb-3" controlId="firstNameForm">
                        <Row>
                            <Col md={2}>
                                <Form.Label className="mx-4">First Name</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="input"
                                    value={userEditInfo.first_name}
                                    className="fs-5"
                                    disabled
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="lastNameForm">
                        <Row>
                            <Col md={2}>
                                <Form.Label className="mx-4">Last Name</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="text"
                                    className="fs-5"
                                    value={userEditInfo.last_name}
                                    disabled
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="DateOfBirthForm">
                        <Row>
                            <Col md={2} >
                                <Form.Label className="mx-4">Date of Birth</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="date"
                                    value={date}
                                    placeholder="Due Date"
                                    className="fs-5"
                                    onChange={(e) => setDate(e.target.value)}
                                />
                            </Col>
                        </Row>
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="genderForm">
                        <Row>
                            <Col md={2} >
                                <Form.Label className="mx-4">Gender</Form.Label>
                            </Col>
                            <Col md={10} style={{ display: "inherit" }}>
                                {["Female", "Male"].map((labelName) => (
                                    <div key={labelName} className="mb-3">
                                        <Form.Check inline>
                                            <Form.Check.Input
                                                type="radio"
                                                id={labelName}
                                                className="fs-5"
                                                checked={
                                                    selectedRadio === labelName
                                                }
                                                name="groupGender"
                                                isInvalid={
                                                    selectedRadio == labelName
                                                }
                                                onChange={() =>
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
                    <Form.Group className="mb-3" controlId="JoinDateForm">
                        <Row>
                            <Col md={2}>
                                <Form.Label className="mx-4">Joined Date</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    type="date"
                                    value={joinDate}
                                    placeholder="Due Join Date"
                                    className="fs-5"
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
                                <Form.Label className="mx-4">Type</Form.Label>
                            </Col>
                            <Col md={10}>
                                <Form.Control
                                    as="select"
                                    defaultValue={type}
                                    className="fs-5"
                                >
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
                                onClick={handleUpdateUserInfo}
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
