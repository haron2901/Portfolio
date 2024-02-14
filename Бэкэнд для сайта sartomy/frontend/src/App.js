import './App.css'
import Menu from "./components/Menu/Menu"
import {useSelector} from "react-redux"
import {BrowserRouter} from "react-router-dom"
import AppRouter from "./components/AppRouter/AppRouter"
import ResizableImage from "./Test"
import FabricCanvas from "./components/FabricCanvas/FabricCanvas"


function App() {
    const isAuth = useSelector(state => state.isAuth)

    return (
        <div className="App">
            <BrowserRouter>
                {isAuth && <Menu/>}
                <AppRouter/>
            </BrowserRouter>
            {/*<ResizableImage src={'./assets/svg/LogoIcon.svg'} initialSize={{ width: 200, height: 150 }} />*/}

        </div>
    )
}


export default App
