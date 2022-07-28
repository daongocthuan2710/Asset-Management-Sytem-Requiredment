import { userConstants } from "../Constants";
const { GET_USER_EDIT } = userConstants;

const initState = {
    userEditInfo: {},
    value:false
};

const userEditReducer = (state = initState, action) => {
    switch (action.type) {
        case GET_USER_EDIT:
            return {
                ...state,
                value: action.payload.value,
                userEditInfo: action.payload.data,
            };
        default:
            return state;
    }
};

export default userEditReducer;
