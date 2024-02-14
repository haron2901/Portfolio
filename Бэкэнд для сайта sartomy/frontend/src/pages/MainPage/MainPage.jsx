import React from 'react'
import styles from './MainPage.module.css'
import Menu from "../../components/Menu/Menu"
import {useSelector} from "react-redux"
import Products from "../../components/Products/Products"
import CreateCustom from "../../components/CreateCustom/CreateCustom"
import Projects from "../../components/Projects/Projects"
import QuickTool from "../../components/QuickTool/QuickTool"
import ProjectEditor from "../../components/ProjectEditor/ProjectEditor"

const MainPage = () => {
    const activeComponent = useSelector(state => state.activeComponent)
    console.log(activeComponent)
    return (
        <div className={styles.container}>
            <>
                <Menu/>
            </>
            <>
                { activeComponent === 'products' && <Products/> }
                { activeComponent === 'createCustom' && <CreateCustom/> }
                { activeComponent === 'projects' && <Projects/> }
                { activeComponent === 'quickTool' && <QuickTool/> }
                {/*<ProjectEditor />*/}
            </>
        </div>
    )
}

export default MainPage