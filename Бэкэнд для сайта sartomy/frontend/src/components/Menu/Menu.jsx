import React from 'react'
import styles from './Menu.module.css'
import LogoIcon from "../../assets/svg/LogoIcon"
import ProductIcon from "../../assets/svg/ProductIcon"
import PenIcon from "../../assets/svg/PenIcon"
import DocIcon from "../../assets/svg/DocIcon"
import ToolIcon from "../../assets/svg/ToolIcon"
import {useDispatch, useSelector} from "react-redux"
import {loginAction} from "../../store/reducer"
import Store from "../../store/store"
import SettingIcon from "../../assets/svg/SettingIcon"
import LogoutIcon from "../../assets/svg/LogoutIcon"
import {useNavigate} from "react-router-dom"
import {CREATE_CUSTOM_ROUTE, PRODUCTS_ROUTE, PROJECTS_ROUTE, QUICK_TOOL_ROUTE} from "../../utils/consts"

const Menu = () => {
    const dispatch = useDispatch()
    const logOut = () => dispatch(loginAction(false))

    const navigate = useNavigate()


    return (
        <div className={styles.container}>
            <LogoIcon width={'7rem'} height={'1.75rem'}/>
            <div className={styles.menu}>
                <div className={styles.menuItem} onClick={() => navigate(PRODUCTS_ROUTE)}>
                    <ProductIcon width={'1.5rem'} height={'1.5rem'}/>
                    <span className={styles.menuLabel}>Products</span>
                </div>
                <div className={styles.menuItem} onClick={() => navigate(CREATE_CUSTOM_ROUTE)}>
                    <PenIcon width={'1.5rem'} height={'1.5rem'}/>
                    <span className={styles.menuLabel}>Create Customs</span>
                </div>
                <div className={styles.menuItem} onClick={() => navigate(PROJECTS_ROUTE)}>
                    <DocIcon width={'1.5rem'} height={'1.5rem'}/>
                    <span className={styles.menuLabel}>Projects</span>
                </div>
                <div className={styles.menuItem} onClick={() => navigate(QUICK_TOOL_ROUTE)}>
                    <ToolIcon width={'1.5rem'} height={'1.5rem'}/>
                    <span className={styles.menuLabel}>Quick Tool</span>
                </div>
            </div>
            <div className={styles.bottomSettings}>
                <div className={styles.menuItem}>
                    <SettingIcon width={'1.5rem'} height={'1.5rem'}/>
                    <span className={styles.menuLabel}>Setting</span>
                </div>
                <div className={styles.menuItem} onClick={() => logOut(false)}>
                    <LogoutIcon width={'1.5rem'} height={'1.5rem'}/>
                    <span className={styles.menuLabel}>Logout</span>
                </div>
            </div>
        </div>
    )
}

export default Menu