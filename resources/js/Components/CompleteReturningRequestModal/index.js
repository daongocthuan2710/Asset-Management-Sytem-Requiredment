/* eslint-disable react/prop-types */
/* eslint-disable react/no-unescaped-entities */

import {Button, Col, Container, Modal, Row} from "react-bootstrap";
import React, {useEffect, useState} from "react";
import ReturningService from "../../Services/returning.service";
// import "./style.scss"

export default function CompleteReturningRequest(props) {
    const [show, setShow] = useState(Boolean(props.show))
    const [showModal, setShowModal] = useState(false);
    const [modalHeader, setModalHeader] = useState("");
    const [modalBody, setModalBody] = useState("");

    useEffect(() => {

    }, [show])

    //Handle save button
    const handleUpdateReturningInfo = async () => {
        setShow(false);
        const data = {
            returningId: props.returningId,
            state : 1
        }

        const response = await ReturningService.updateReturningInfo(data);
        console.log('response',response);
        const message =
            response.data == undefined
                ? response.message
                : response.data.message;
        const code = response.code;
        handleShowMessage(code, message);
    }

    function handleShowMessage(code, message) {
        setShowModal(true);
        switch (code) {
            case 200:
                {
                    setModalHeader("Success");
                    setModalBody(message);
                    setTimeout(() => {
                        setShowModal(false);
                    }, 2000);
                }
                break;
            case 422:
                setModalHeader("Failed!");
                setModalBody(message);
                setTimeout(() => {
                    setShowModal(false);
                }, 2000);
                break;
            case 400:
                setModalHeader("Failed!");
                setModalBody(message);
                setTimeout(() => {
                    setShowModal(false);
                }, 2000);
                break;
        }
    }

    //Handle close pop-up
    const handleClose = () => setShow(false);


    useEffect(() => {
        // eslint-disable-next-line react/prop-types
        if (props.show) setShow(Boolean(true))
    }, [props])

    return (
        <>
            <Modal style={{ marginTop: '222px !important' }}
                show={show}
                backdrop="static"
                keyboard={false}
            >
                <Modal.Header>
                    <Modal.Title id="pwChangePasswordHeader">Are you sure?</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    {
                        <Container id='pwChangePasswordFirstContainer' style={{width: "max-content"}}>
                                <Row>
                                    <p style={{marginBottom: "-1px"}}>Do you want to mark this returning request as 'Completed'?</p>
                                </Row>
                                <Row className = "text-start">
                                    <Col>
                                        <Button onClick={handleUpdateReturningInfo}
                                                id="pwSaveButton"
                                                variant="primary">
                                            Yes
                                        </Button>
                                        <b>&emsp;</b>
                                        <Button onClick={handleClose}
                                                id="pwCancelButton"
                                                variant="light">
                                            No
                                        </Button>
                                    </Col>
                                </Row>
                            </Container>
                    }
                </Modal.Body>
            </Modal>
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
    )
}
