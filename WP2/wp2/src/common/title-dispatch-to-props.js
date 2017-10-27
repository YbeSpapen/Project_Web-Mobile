/**
 * Created by Spape on 27/10/2017.
 */
const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        setTitle: (title) => {
            dispatch({type: 'SET_TITLE', payload: title});
        }
    }
}
export default mapDispatchToProps;
