const initialState = {
    title: 'Home',
    selectedRow: 0,
    technician_id: 0,
    technicians: []
};

const layoutreducer = (state = initialState, action) => {
    switch (action.type) {
        case 'SET_TITLE':
            return {...state, ...{title: action.payload}};
        case 'SET_SELECTED':
            return {...state, selectedRow: action.payload};
        case 'SET_SELECTEDTECHNICIAN':
            return {...state, technician_id: action.payload};
        case 'SET_TECHNICIANENTRIES':
            return {...state, ...{technicians: action.payload}};
        case 'ADD_TECHNICIANENTRY':
            return {...state, ...{technicians: [...state.technicians, action.payload]}};
        default:
            return state;
    }
};

export default layoutreducer;