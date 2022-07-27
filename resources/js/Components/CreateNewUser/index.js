import React from "react";
import { Container, Row, Col, Button, Form, } from "react-bootstrap";
import axios from "../../Services/base.service";
import "./style.css";
// import { useHistory } from "react-router-dom";

const CreateNewUser = () => {
  // let history = useHistory();
  const [firstName, setFirstName] = React.useState("");
  const [lastName, setLastName] = React.useState("");
  const [dateOfBirth, setDateOfBirth] = React.useState("");
  const [gender, setGender] = React.useState();
  const [joinedDate, setJoinedDate] = React.useState("");
  const [type, setType] = React.useState();
  const [mess, setMess] = React.useState("");
  React.useEffect(() => {
    console.log("SignIn");
  }, []);

  const checkForm = () => {
    if (username === "" || password === "") {
      // setMess("Please enter username and password");
      return true;
    }
    return false;
  }


  const handleSubmit = (e) => {
    const data = {
      firstName: firstName,
      lastName: lastName,
      dateOfBirth: dateOfBirth,
      gender: gender,
      joinedDate: joinedDate,
      type: type,

    };
    e.preventDefault();
    console.log(data);

  }
  // const handleLogin = async (e) => {
  //   e.preventDefault();
  //   try {
  //     const data = {
  //       username: username,
  //       password: password,
  //     };

  //     const response = await axios.post("/login", data);

  //     console.log(response.data.message);
  //     localStorage.setItem("token", response.data.token);


  //     window.location.href = "/HomePage";
  //   } catch (err) {
  //     console.log(err.response.data.message);
  //     setMess(err.response.data.message);
  //   }
  // };

  return (
    <>
      <Container>
        <Row>
          <Col xs={12} md={8}>
            <div className="content">
              <Form onSubmit={(e) => handleSubmit(e)}>
                <Form.Group className="mb-3" controlId="formBasicText">
                  <Form.Label>First Name</Form.Label>
                  <Form.Control
                    type="text"
                    value={firstName}
                    onChange={(e) => setFirstName(e.target.value)}
                  />
                </Form.Group>

                <Form.Group className="mb-3" controlId="formBasicText">
                  <Form.Label>Last Name</Form.Label>
                  <Form.Control
                    type="text"
                    value={lastName}
                    onChange={(e) => setLastName(e.target.value)}
                  />
                </Form.Group>
                <Form.Group className="mb-3" controlId="formBasicDate">
                  <Form.Label>Date of Birth</Form.Label>
                  <Form.Control
                    type="date"
                    value={dateOfBirth}
                    placeholder=""
                    onChange={(e) => setDateOfBirth(e.target.value)}
                  />
                </Form.Group>

                <Form.Group className="mb-3" controlId="formGender" >
                  <Form.Label>Gender</Form.Label>
                  <Form.Check
                    name="gender"
                    type="radio"
                    value={false}
                    onChange={(e) => setGender(e.target.value)}
                    label="Female"
                  />
                  <Form.Check
                    name="gender"
                    type="radio"
                    value={true}
                    onChange={(e) => setGender(e.target.value)}
                    label="Male"
                  />
                </Form.Group>


                <Form.Group className="mb-3" controlId="formJoinedDate">
                  <Form.Label>Joined Date</Form.Label>
                  <Form.Control
                    type="date"
                    value={joinedDate}
                    placeholder=""
                    onChange={(e) => setJoinedDate(e.target.value)}
                  />
                </Form.Group>


                <Form.Group controlId="formBasicSelect">
                  <Form.Label>Type</Form.Label>
                  <Form.Control
                    as="select"
                    onChange={e => {
                      setType(e.target.value)
                    }}
                  >
                    <option value={true}>Admin</option>
                    <option value={false}>Staff</option>
                  </Form.Control>
                </Form.Group>

                <Button className="btn-submit" disabled={''} type="submit">
                  Save
                </Button>
              </Form>
            </div>
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default CreateNewUser;
