/* eslint-disable no-unused-vars */
/* eslint-disable react/prop-types */
/* eslint-disable react/jsx-no-duplicate-props */
import React from "react";
import axios from "axios";

import {
    Dropdown, Form
} from "react-bootstrap";
import {
    FaFilter
} from 'react-icons/fa';
export default function FilterByCategory({
    currentButton,
    handleFilter,
    arrayState,
    filterCategory
}) {
    React.useEffect(() => {
        getApiCategory();
    }, []);
    const [category, setCategory] = React.useState([]);
    const token = localStorage.getItem("token");
    const headers = { headers: { Authorization: `Bearer ${token}` } };
    const getApiCategory = async () => {
        await axios.get("/api/category", headers)
            .then(function (response) {
                setCategory(response.data.category);
            })
    }

    const checkId = (id) => {
        if (filterCategory.length > 0) {
            const index = filterCategory.findIndex((e) => e === id);
            if (index !== -1 && filterCategory[index] === id) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    return (
        <>
            <Dropdown onSelect={() => handleFilter}>
                <Dropdown.Toggle className="filter-button d-flex align-items-center justity-content-center ">
                    <p className="flex-grow-1 font-weight-bold mb-0">Category</p>
                    <div className="fb-icon">
                        <FaFilter />
                    </div>
                </Dropdown.Toggle>
                <Dropdown.Menu>
                    <Form>
                        <Form.Check key={"All"}
                            type="checkbox"
                            id="checkbox-all"
                            className="mx-4 my-2 font-weight-bold"
                            label={"All"}
                            checked={checkId("All")}
                            onChange={() => handleFilter("All")}
                            eventKey={"All"}
                        />
                        {category.length > 0 && category.map((item, index) => (
                            <Form.Check key={index}
                                type="checkbox"
                                id="checkbox-all"
                                className="mx-4 my-2 font-weight-bold"
                                label={item.name}
                                checked={checkId(item.id)}
                                onChange={() => handleFilter(item.id)}
                                eventKey={item.id}
                            />
                        ))}
                    </Form>
                </Dropdown.Menu>
            </Dropdown>
        </>
    );
}