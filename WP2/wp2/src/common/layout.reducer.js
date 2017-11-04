/**
 * Created by Spape on 22/10/2017.
 */
const initialState = {
<<<<<<< HEAD
    title: 'Home',
    selectedRow: 0,
    technician_id: 0
=======
    title: 'Locations',
    calorieEntries: [],
    selectedRow: 0
>>>>>>> 1731b81d1bbd5880cf092b4a7f13be87ff2e9e1d
};

const layoutreducer = (state = initialState, action) => {
    switch (action.type) {
        case 'SET_TITLE':
            return {...state, ...{title: action.payload}};
        case 'SET_SELECTION':
            return {...state, selectedRow: action.payload};
        case 'ASSIGN_TECHNICIAN_ID':
            return {...state, technician_id: action.payload};
        default:
            return state;
    }
};

export default layoutreducer;