import React from "react";
import "./style.scss";
import "./style.css";
import { Loading } from "notiflix/build/notiflix-loading-aio";
import Row from "react-bootstrap/Row";
import axios from "axios";
import Swal from "sweetalert2";
import { getUserEdit } from "../../Actions/user.action";
import { useDispatch, useSelector } from "react-redux";
import Nodata from "../../../assets/Nodata.gif";
import DisableUser from "../DisableUser";
import userService from "../../Services/user.service";
import CustomPagination from "./CustomPagination";
import AssetTable from "./AssetTable";
import FilterByCategory from "./FilterByCategory";
import SearchCreate from "./SearchCreate";
import AssetDetailModal from "./AssetDetailModal";

export default function ManageAsset() {
  const [currentButton, setFilter] = React.useState("All");
  const [currentSearch, setCurrentSearch] = React.useState("");
  const [page, setPage] = React.useState(1);
  const [total, setTotal] = React.useState(1);
  const [sortArray, setSortArray] = React.useState([]);
  const [disableUser, setDisableUser] = React.useState({ show: false, id: 0 });
  const [modal, setModal] = React.useState(false);

  const sort_update_at = useSelector(
    (state) => state.userEditReducer.sort_update_at
  );

  const sort_create_at = useSelector(
    (state) => state.userEditReducer.sort_update_at
  );

  const [tableHeader, setTableHeader] = React.useState([
    {
      name: "Asset Code",
      isSortASC: true,
      isSortDESC: false,
    },
    {
      name: "Asset Name",
      isSortASC: true,
      isSortDESC: false,
    },
    {
      name: "Category",
      isSortASC: true,
      isSortDESC: false,
    },
    {
      name: "State",
      isSortASC: true,
      isSortDESC: false,
    },
  ]);

  const [data, setData] = React.useState([]);

  React.useEffect(() => {
    getApiUser();
  }, []);
  const handleDisableUser = (e, id) => {
    e.stopPropagation();
    setDisableUser({ show: true, id: id });
    console.log(disableUser);
    setTimeout(() => setDisableUser({ show: false, id: id }), 1);
  }

  const getApiUser = async ({
    filter = undefined,
    search = undefined,
    page = 1,
    sort = undefined,
  } = {}) => {
    let url = "api/asset";
    let array = [];

    if (filter && filter !== "All") {
      array.push(`filter=${filter === "Admin" ? true : false}`);
    }

    if (search) {
      array.push(`search=${search}`);
    }

    if (page) {
      array.push(`page=${page}`);
    }
    if (sort_update_at === 'sortByEditAsset') {
      array.push('sortByEditAsset');

    }
    if (sort_create_at === 'sortByCreateAsset') {
      array.push('sortByCreateAsset');
    }

    console.log(sort_create_at);




    if (sort) {
      sort.forEach((item) => {
        if (item.key === "Asset Code") {
          array.push(`sortByAssetCode=${item.value}`);
        }
        if (item.key === "Asset Name") {
          array.push(`sortByName=${item.value}`);
        }
        if (item.key === "Category") {
          array.push(`sortByCategory=${item.value}`);
        }
        if (item.key === "State") {
          array.push(`sortByState=${item.value}`);
        }
      });
    }

    for (let i = 0; i < array.length; i++) {
      if (i === 0) {
        url += "?" + array[i];
      } else {
        url += "&" + array[i];
      }
    }

    Loading.dots({
      clickToClose: true,
      svgSize: "100px",
      svgColor: "rgb(220 53 69)",
    });
    const response = await axios.get(url, {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    });
    Loading.remove();
    setData(response.data.data);
    setTotal(response.data.meta.total);
    return response.data;
  };
  const handleFilter = (value) => {
    setFilter(value);
    let temp_page;
    let temp_search;
    let temp_sort;
    if (temp_search) {
      temp_search = currentSearch;
    }

    if (temp_page >= 1) {
      temp_page = page;
    }
    if (sortArray.length > 0) {
      temp_sort = [...sortArray];
    }



    setPage(1);

    getApiUser({
      filter: value,
      page: temp_page,
      temp_search: temp_search,
      sort: temp_sort,
    });
  };

  const handleSearch = (e) => {
    e.preventDefault();
    let temp_filter;
    let temp_page;
    let temp_sort;
    if (currentButton !== "All") {
      temp_filter = currentButton;
    }
    if (temp_page >= 1) {
      temp_page = page;
    }
    if (sortArray.length > 0) {
      temp_sort = [...sortArray];
    }

    getApiUser({
      filter: temp_filter,
      search: currentSearch,
      page: temp_page,
      sort: temp_sort,
    });
  };
  const handlePageChange = (pageNumber) => {
    setPage(pageNumber);
    console.log(page);

    let temp_filter;
    let temp_search;
    let temp_sort;

    if (currentButton !== "All") {
      temp_filter = currentButton;
    }

    if (currentSearch !== "") {
      temp_search = currentSearch;
    }

    if (sortArray.length > 0) {
      temp_sort = [...sortArray];
    }

    getApiUser({
      filter: temp_filter,
      search: temp_search,
      page: pageNumber,
      sort: temp_sort,
    });
  };
  const handleSort = (key, value) => {
    let temp_filter;
    let temp_page;
    let temp_search;

    if (currentButton !== "All") {
      temp_filter = currentButton;
    }

    if (temp_page >= 1) {
      temp_page = page;
    }
    if (temp_search) {
      temp_search = currentSearch;
    }

    const tempSortArray = JSON.parse(JSON.stringify(sortArray));
    const tempHeader = JSON.parse(JSON.stringify(tableHeader));

    const index = tempSortArray.findIndex((item) => item.key === key);

    const indexHeader = tempHeader.findIndex((item) => item.name === key);

    if (index === -1 && value) {
      tempSortArray.push({
        key: key,
        value: "desc",
      });
      tempHeader[indexHeader].isSortASC = false;
      tempHeader[indexHeader].isSortDESC = true;
    }
    if (index !== -1 && !value) {
      tempSortArray.splice(index, 1);
      tempHeader[indexHeader].isSortASC = true;
      tempHeader[indexHeader].isSortDESC = false;
    }
    if (index !== -1 && value) {
      tempSortArray[index].value = "desc";
      tempHeader[indexHeader].isSortASC = false;
      tempHeader[indexHeader].isSortDESC = true;
    }
    setTableHeader(tempHeader);
    setSortArray(tempSortArray);

    getApiUser({
      filter: temp_filter,
      search: currentSearch,
      page: page,
      sort: tempSortArray,
    });
  };

  const dispatch = useDispatch();
  async function handleOpenEditForm(e, userId = "") {
    e.stopPropagation();
    const displayValue = true;
    const response = await dispatch(getUserEdit(displayValue, userId));
    handleShowMessage(response);
  }

  function handleShowMessage(response) {
    const message =
      response.data == undefined ? response.message : response.data.message;
    const code = response.code;
    switch (code) {
      case 200:
        {
          //
        }
        break;
      case 401:
        {
          Swal.fire({
            position: "center",
            icon: "info",
            title: message,
            showConfirmButton: false,
            timer: 2000,
          });
        }
        break;
    }
  }
  const [user, setUser] = React.useState([]);

  const handleGetUserById = async (userId) => {
    const response = await userService.getUserById(userId);
    setModal(true);
    console.log(response);
    setUser(response.data.data);
  }

  return (
    <div className="containermanageuser">
      <DisableUser show={disableUser.show} id={disableUser.id} />
      <h5 style={{ color: "red", fontWeight: "bold" }}>User List </h5>
      <div id="filter-search" className="d-flex justify-content-between type-seach-create">
        <FilterByCategory
          currentButton={currentButton}
          handleFilter={handleFilter}
        />
        <div id="search-create" className="d-flex search-create">
          <SearchCreate
            currentSearch={currentSearch}
            handleSearch={handleSearch}
            setCurrentSearch={setCurrentSearch}
          />
        </div>
      </div>
      <Row>
        <div id="table-manage-user">
          <AssetTable
            data={data}
            tableHeader={tableHeader}
            Nodata={Nodata}
            handleSort={handleSort}
            handleOpenEditForm={handleOpenEditForm}
            handleGetUserById={handleGetUserById}
            handleDisableUser={handleDisableUser}
          />
        </div>
      </Row>
      <Row>
        <CustomPagination
          total={total}
          page={page}
          handlePageChange={handlePageChange}
        />
      </Row>
      <AssetDetailModal
        modal={modal}
        user={user}
        setModal={setModal}
      />
    </div>
  );
};
