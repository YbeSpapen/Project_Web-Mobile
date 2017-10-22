/**
 * Created by Spape on 22/10/2017.
 */
const initialState = {
    title: 'Home',
    calorieEntries: [],
    selectedRow: 0
};

const layoutreducer = (state = initialState, action) => {
    switch (action.type) {
        case 'SET_TITLE':
            return {...state, ...{title: action.payload}};
        case 'SET_SELECTION':
            return {...state, selectedRow: action.payload};
        default:
            return state;
    }
}

export default layoutreducer;