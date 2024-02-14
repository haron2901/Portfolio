import React from 'react'
import {Route, Routes} from "react-router-dom"
import {useSelector} from "react-redux"
import LoginPage from "../../pages/LoginPage/LoginPage"
import {routes} from "../../utils/routes"

const AppRouter = () => {
    const isAuth = useSelector(state => state.isAuth)

    return (
        <Routes>
            {!isAuth && <Route Component={LoginPage} path={'/'} /> }
            {isAuth && routes.map(({path, Component}) =>
                <Route Component={Component} path={path} key={path}/>
            )}
        </Routes>
    )
}

export default AppRouter