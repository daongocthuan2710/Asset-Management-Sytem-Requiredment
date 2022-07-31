import {
    Dropdown, Form
} from "react-bootstrap";
import {
    FaFilter
} from 'react-icons/fa';
export default function FilterByCategory({
    currentButton,
    handleFilter
}) {
    return (
        <>
            <Dropdown onSelect={() => handleFilter}>
                <Dropdown.Toggle className="filter-button d-flex align-items-center justity-content-center ">
                    <p className="flex-grow-1 font-weight-bold mb-0">Type</p>
                    <div className="fb-icon">
                        <FaFilter />
                    </div>
                </Dropdown.Toggle>
                <Dropdown.Menu>
                    <Form>
                        <Form.Check
                            type="checkbox"
                            id="checkbox-all"
                            className="mx-4 font-weight-bold"
                            label="All"
                            checked={currentButton === "All"}
                            onChange={() => handleFilter("All")}
                            eventKey="All"
                        />
                        <Form.Check
                            type="checkbox"
                            id="checkbox-admin"
                            className="mx-4 my-2 font-weight-bold"
                            label="Admin"
                            checked={currentButton === "Admin"}
                            onChange={() => handleFilter("Admin")}
                            eventKey="Admin"
                        />
                        <Form.Check
                            type="checkbox"
                            id="checkbox-staff"
                            className="mx-4 font-weight-bold"
                            label="Staff"
                            checked={currentButton === "Staff"}
                            onChange={() => handleFilter("Staff")}
                            eventkey="Staff"
                        />
                    </Form>
                </Dropdown.Menu>
            </Dropdown>
        </>
    );
}