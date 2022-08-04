/* eslint-disable no-unused-vars */
/* eslint-disable react/prop-types */
/* eslint-disable react/jsx-no-duplicate-props */
import DatePicker from "react-datepicker";
import React, { useState } from "react";
import "react-datepicker/dist/react-datepicker.css";
import moment from "moment";

import {
    Dropdown, Form
} from "react-bootstrap";
import {
    FaFilter
} from 'react-icons/fa';
export default function FilterByAssignedDate({
    currentButton,
    handleFilter,
    arrayState,
    handleFilterDate
}) 

{
    const [startDate, setStartDate] = useState(new Date());
        
    return (    
        <>
            <Dropdown >
                <Dropdown.Toggle id="button-assigned-date" className="filter-button d-flex align-items-center justity-content-center ">
                    <p className="flex-grow-1 font-weight-bold mb-0">Assigned Date</p>
                    <div className="fb-icon">
                        <FaFilter />
                    </div>
                </Dropdown.Toggle>
                <Dropdown.Menu>
                <Form.Group controlId="formBasicDate">


            
                <DatePicker  dateFormat="dd/MM/yyyy" selected={startDate}  onChange={(startDate) =>{ 
                    handleFilterDate(moment(startDate).format('DD-MM-YYYY'));
                    setStartDate(startDate);
                }}  />
         
          </Form.Group>
                </Dropdown.Menu>
            </Dropdown>
        </>
    );
}