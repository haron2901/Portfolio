import React, {useRef, useState} from 'react'
import styles from './Error.module.css'


const Error = ({isError}) => {
    const [isVisible, setIsVisible] = useState(true)
    const rootStyles = [styles.container]

    if (isVisible) {
        rootStyles.push(styles.showAnimation)
    } else {
        rootStyles.push(styles.hideAnimation)
    }

    return (
        <>
            {
                // isError &&
                <div className={rootStyles.join(' ')} onClick={() => setIsVisible(!isVisible)}>
                    {isVisible.toString()}
                </div>
            }
        </>

    )
}

export default Error