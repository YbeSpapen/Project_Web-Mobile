import React, {Component} from "react";
import MultiThemeProvider from "material-ui/styles/MuiThemeProvider";
import Layout from "./layout";
import {Provider} from "react-redux";
import store from "./common/store";

class App extends Component {
    render() {
        return (
            <Provider store={store}>
                <MultiThemeProvider>
                    <Layout/>
                </MultiThemeProvider>
            </Provider>
        );
    }
}

export default App;
