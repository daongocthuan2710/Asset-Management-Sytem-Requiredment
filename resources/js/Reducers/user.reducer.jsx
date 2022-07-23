import { userConstants } from "../Constants";
const { GET_USER_INFO } = userConstants;

const initState = {
    userInfo: {},
};

const userReducer = (state = initState, action) => {
    switch (action.type) {
        case GET_USER_INFO:
            return {
                ...state,
                userInfo: action.payload.data,
            };
        default:
            return state;
    }
};

export default userReducer;
