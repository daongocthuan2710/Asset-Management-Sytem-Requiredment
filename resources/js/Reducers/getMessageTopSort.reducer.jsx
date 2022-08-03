//import { userConstants } from "../Constants";
//const { GET_ASSET_EDIT } = userConstants;
const initState = {
    sort_at:'',
};

const assetGetMessageReducer = (state = initState, action) => {
    switch (action.type) {
        case 'GET_MESSAGE':
            return {
                ...state,
                sort_at: action.payload.sort_at,
            };
        default:
            return state;
    }
};

export default assetGetMessageReducer;
