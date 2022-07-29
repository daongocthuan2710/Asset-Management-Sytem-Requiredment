import React from "react";
import { Container, Row, Col, Button, Form, } from "react-bootstrap";
import axios from "../../Services/base.service";
import "./style.css";
import { useHistory } from "react-router-dom";

const CreateNewUser = () => {
  let history = useHistory();
  const [firstName, setFirstName] = React.useState("");
  const [lastName, setLastName] = React.useState("");
  const [dateOfBirth, setDateOfBirth] = React.useState("");
  const [gender, setGender] = React.useState(null);
  const [joinedDate, setJoinedDate] = React.useState("");
  const [type, setType] = React.useState(0);
  const [mess, setMess] = React.useState("");
  const [enabled, setEnabled] = React.useState(true)
  const [dateOfBirthError, setDateOfBirthError] = React.useState({error: false, message: ""})
  const [joinedDateError, setJoinedDateError] = React.useState({error: false, message: ""})

  React.useEffect(() => {
    setEnabled(true)
    if (firstName !== "" && lastName !== "" && dateOfBirth !== "" && gender !== null && joinedDate !== "" && type !== null)
      setEnabled(false)
  }, [firstName, lastName, dateOfBirth, gender, type, joinedDate]);


  const dateOfBirthCheck = ((date)=>{
    
    if (new Date(date).getFullYear() > (new Date().getFullYear()-18)){
    setDateOfBirthError({error:true,message:"User is under 18. Please select a different date"});
    setDateOfBirth("");}
    else {
      setDateOfBirth(date);
      setDateOfBirthError({error:false,message:""})
    }
    
  })

  const joinDateCheck = ((date)=>{
    if (date<dateOfBirth){
    setJoinedDateError({error: true, message: "Joined date is not later than Date of Birth. Please select a different date"})
    setJoinedDate("")}
    else if(new Date(date).getDay() !== 4 && new Date(date).getDay() !== 5){
      setJoinedDateError({error: true, message: "Joined date is Saturday or Sunday. Please select a different date"})
      setJoinedDate("")
    }
    else {
      setJoinedDateError({error: false, message: ""})
      setJoinedDate(date)
  
    }
    
    
    
  })


  const handleSubmit = async (e) => {
    try {
      const data = {
        "first_name": firstName,
        "last_name": lastName,
        "date_of_birth": dateOfBirth,
        "gender": gender,
        "joined_date": joinedDate,
        "admin": type,
      };
      e.preventDefault();
      console.log(data);
      const token = localStorage.getItem('token')
      const headers = { headers: { Authorization: `Bearer ${token}` } };
      
      const response = await axios.post("/user/store", data, headers);
      console.log(response);
      history.push("/manage-user");
    } catch (err) {
      console.log(err.response.data.message);
      setMess(err.response.data.message);
    }

  }

  return (
    <>
      <Container>
        <h4><b>Create New User</b></h4><br></br>
        <Form onSubmit={(e) => handleSubmit(e)}>
          <Form.Group controlId="formBasicText">
            <Row>
              <Col >
                <Form.Label>First Name</Form.Label>
              </Col><Col md={8}>
                <Form.Control
                  required
                  type="text"
                  value={firstName}
                  onChange={(e) => setFirstName(e.target.value)}
                />
              </Col>
            </Row>
          </Form.Group>
          <br></br>
          <Form.Group controlId="formBasicText">
            <Row>
              <Col>
                <Form.Label>Last Name</Form.Label>
              </Col><Col md={8}>
                <Form.Control
                  type="text"
                  value={lastName}
                  onChange={(e) => setLastName(e.target.value)}
                />
              </Col>
            </Row>
          </Form.Group>

          <br></br>
          <Form.Group controlId="formBasicDate">
            <Row>
              <Col >
                <Form.Label>Date of Birth</Form.Label>
              </Col><Col md={8}>
                <Form.Control
                  required 
                  type="date"
                  onChange={(e) => dateOfBirthCheck(e.target.value)}
                  isInvalid={dateOfBirthError.error}
                />
                <Form.Control.Feedback type="invalid">{dateOfBirthError.message}</Form.Control.Feedback>
              </Col>
            </Row>

          </Form.Group>
          <br></br>
          <Form.Group controlId="formGender" >
            <Row>
              <Col>
                <Form.Label>Gender</Form.Label>
              </Col><Col md={4}>
                <Form.Check
                  name="gender"
                  type="radio"
                  value={0}
                  onChange={(e) => setGender(e.target.value)}
                  label="Female"
                /></Col>
              <Col md={4}>
                <Form.Check
                  name="gender"
                  type="radio"
                  value={1}
                  onChange={(e) => setGender(e.target.value)}
                  label="Male"
                /></Col>
            </Row>
          </Form.Group>

          <br></br>
          <Form.Group controlId="formJoinedDate">
            <Row>
              <Col>
                <Form.Label>Joined Date</Form.Label>
              </Col><Col md={8}>
                <Form.Control
                  type="date"
                  onChange={(e) => joinDateCheck(e.target.value)}
                  isInvalid={joinedDateError.error}
                />
                <Form.Control.Feedback type="invalid">{joinedDateError.message}</Form.Control.Feedback>
              </Col>
            </Row>
          </Form.Group>

          <br></br>
          <Form.Group controlId="formBasicSelect">
            <Row>
              <Col>

                <Form.Label>Type</Form.Label>
              </Col><Col md={8}>
                <Form.Control
                  as="select"
                  onChange={e => {
                    setType(e.target.value)
                  }}
                >
                  <option value={0}>Staff</option>
                  <option value={1}>Admin</option>

                </Form.Control>
              </Col>
            </Row>
          </Form.Group>
          <br></br>
          <p className="err-msg">{mess} </p>
          <Form.Group className="text-end">
            <Button className="me-3"
              variant="danger"
              type="submit"
              disabled={enabled}
            >
              Save
            </Button>
            <Button variant="outline-secondary" onClick={() => history.push("/manage-user") }>
              Cancle
            </Button>
          </Form.Group>
        </Form>

      </Container>
    </>
  );
};

export default CreateNewUser;
