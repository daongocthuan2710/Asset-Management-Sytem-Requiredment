import {
    Form, InputGroup, Button
} from 'react-bootstrap'
import {
    FaSearch,
} from "react-icons/fa"
import { Link } from "react-router-dom";

export default function SearchCreate({
    currentSearch,
    handleSearch, setCurrentSearch
}) {
    return (
        <>
            <Form id="form-search" onSubmit={(e) => handleSearch(e)}>
                <InputGroup className="search-bar mb-1">
                    <Form.Control
                        placeholder="Search"
                        aria-label="Text input with dropdown button"
                        value={currentSearch}
                        onChange={(e) => setCurrentSearch(e.target.value)}
                    />
                    <InputGroup.Text
                        id="basic-addon2"
                        onClick={(e) => handleSearch(e)}
                    >
                        {" "}
                        <FaSearch />
                    </InputGroup.Text>
                </InputGroup>
            </Form>
            <Link to="/create-user">
                <Button id="btn-createnewuser" className="btn-createnewuser" >
                    Create new Asset
                </Button>
            </Link>
        </>
    );
}