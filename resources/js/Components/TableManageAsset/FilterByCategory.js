import React from "react";
import {
    Dropdown, Form
} from "react-bootstrap";
import {
    FaFilter
} from 'react-icons/fa';
export default function FilterByCategory({
    currentButton,
    handleFilter,
    arrayState
}) {
    return (
        <>
            <Dropdown onSelect={() => handleFilter}>
                <Dropdown.Toggle className="filter-button d-flex align-items-center justity-content-center ">
                    <p className="flex-grow-1 font-weight-bold mb-0">State</p>
                    <div className="fb-icon">
                        <FaFilter />
                    </div>
                </Dropdown.Toggle>
                <Dropdown.Menu>
                    <Form>
                    {/* filterArray[props.filterArray.findIndex(item => item === "-1").value === '-1'] */}
                        <Form.Check
                            type="checkbox"
                            id="checkbox-all"
                            className="mx-4 font-weight-bold"
                            label="All"
                            checked={currentButton === "All"}
                            onChange={() => handleFilter("All", "3")}
                            eventKey="3"
                        />
                        <Form.Check 
                            type="checkbox"
                            id="checkbox-admin"
                            className="mx-4 my-2 font-weight-bold"
                            label="Assigned"
                            checked={arrayState.length >0 && arrayState.findIndex(item => item.value === "2") !== -1 && arrayState[arrayState.length >0 && arrayState.findIndex(item => item.value === "2")].value === "2"}

                            onChange={() => handleFilter("Assigned", "2")}
                            eventKey="2"
                        />
                        <Form.Check
                            type="checkbox"
                            id="checkbox-staff"
                            className="mx-4 font-weight-bold"
                            label="Available"
                            checked={arrayState.length >0 && arrayState.findIndex(item => item.value === "1") !== -1 && arrayState[arrayState.length >0 && arrayState.findIndex(item => item.value === "1")].value === "1"}
                            onChange={() => handleFilter("Available", "1")}
                            eventkey="1"
                        />
                        <Form.Check
                            type="checkbox"
                            id="checkbox-staff"
                            className="mx-4 font-weight-bold"
                            label="Not Available"
                            checked={arrayState.length >0 && arrayState.findIndex(item => item.value === "0") !== -1 && arrayState[arrayState.length >0 && arrayState.findIndex(item => item.value === "0")].value === "0"}
                            onChange={() => handleFilter("Not Available", "0")}
                            eventkey="0"
                        />        
                        <Form.Check
                            type="checkbox"
                            id="checkbox-staff"
                            className="mx-4 font-weight-bold"
                            label="Waiting for recycling"
                            checked={arrayState.length >0 && arrayState.findIndex(item => item.value === "-1") !== -1 && arrayState[arrayState.length >0 && arrayState.findIndex(item => item.value === "-1")].value === "-1"}
                            onChange={() => handleFilter("Waiting for recycling", "-1")}
                            eventkey="-1"
                        />       
                         <Form.Check
                            type="checkbox"
                            id="checkbox-staff"
                            className="mx-4 font-weight-bold"
                            label="Recycled"
                            checked={arrayState.length >0 && arrayState.findIndex(item => item.value === "-2") !== -1 && arrayState[arrayState.length >0 && arrayState.findIndex(item => item.value === "-2")].value === "-2"}
                            onChange={() => handleFilter("Recycled", "-2")}
                            eventkey="-2"
                        />               

                    </Form>
                </Dropdown.Menu>
            </Dropdown>
        </>
    );
}