const initialState = {
    title: 'Home',
    selectedRow: 0,
    technician_id: 0
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