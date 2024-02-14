import React from 'react'
import styles from './Input.module.css'

const Input = ({placeholder, onChange, value, style}) => {
    return (
        <input
            placeholder={placeholder}
            onChange={onChange}
            style={style}
            className={styles.input}
            value={value}
        />
    )
}

export default Input