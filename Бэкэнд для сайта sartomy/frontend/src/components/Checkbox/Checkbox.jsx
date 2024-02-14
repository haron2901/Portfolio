import React, {useState} from 'react'
import styles from './Checkbox.module.css'

const Checkbox = ({isActive}) => {
    const activeStyles = [styles.container]
    isActive && activeStyles.push(styles.active)
    return (
        <div className={activeStyles.join(' ')} >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 style={isActive ? {opacity: 1, transition: '.5s'} :  {opacity: 0, transition: '.2s'}}>
                <path
                    d="M9.08316 16.0542L5.02899 12L3.64844 13.3708L9.08316 18.8056L20.7498 7.1389L19.379 5.76807L9.08316 16.0542Z"
                    fill="#1E3244"/>
            </svg>

        </div>
    )
}

export default Checkbox