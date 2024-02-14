import React, {useEffect, useState} from 'react'
import LogoIcon from "../../assets/svg/LogoIcon"
import Input from "../../ui/Input/Input"
import useInput from "../../hooks/useInput"
import styles from './LoginPage.module.css'
import Button from "../../ui/Button/Button"
import {useDispatch} from "react-redux"
import {loginAction} from "../../store/reducer"
import LoginIcon from "../../assets/svg/LoginIcon"
import {PHONE_WIDTH, PRODUCTS_ROUTE, TABLET_WIDTH} from "../../utils/consts"
import {useNavigate} from "react-router-dom"

const LoginPage = () => {
    const loginInput = useInput('', 'LoginPage')
    const passwordInput = useInput('', 'Password')
    const dispatch = useDispatch()
    const navigate = useNavigate()
    const login = () => dispatch(loginAction(true))

    const [windowWidth, setWindowWidth] = useState(window.innerWidth)

    const handleResize = () => {
        setWindowWidth(window.innerWidth)
    }

    useEffect(() => {
        window.addEventListener('resize', handleResize)

        return () => {
            window.removeEventListener('resize', handleResize)
        }
    }, [])


    return (
        <div className={styles.container}>
            <LogoIcon width={'15.625rem'} height={'3.75rem'}/>
            <div className={styles.inputsContainer}>
                <Input
                    style={{width: windowWidth > TABLET_WIDTH ? '25rem' : windowWidth > PHONE_WIDTH ? '30rem' : '100%'}}
                    placeholder={loginInput.placeholder}
                    onChange={loginInput.onChange}
                    value={loginInput.value}
                />
                <Input
                    style={{width: windowWidth > TABLET_WIDTH ? '25rem' : windowWidth > PHONE_WIDTH ? '30rem' : '100%'}}
                    placeholder={passwordInput.placeholder}
                    onChange={passwordInput.onChange}
                    value={passwordInput.value}
                />
            </div>
            <Button
                onClick={() => {
                    login()
                    navigate(PRODUCTS_ROUTE)
                }}
                style={{width: '17.9375rem', padding: '.88rem 0', fontSize: '1.125rem'}}
            >
                <div className={styles.buttonContent}>
                    <span>LOGIN</span>
                    <LoginIcon width={'1.125rem'} height={'1.125rem'}/>
                </div>

            </Button>

        </div>
    )
}

export default LoginPage