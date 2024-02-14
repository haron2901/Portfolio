import React from 'react'

const ResizeIcon = ({width, height}) => {
    return (
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" style={{width: width, height: height}}>
            <path d="M13 1H19V7" stroke="#1E3244" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
            <path d="M13.5 12.5H7.5V6.5" stroke="#1E3244" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
            <path d="M19 1L7.5 12.5" stroke="#1E3244" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
            <path d="M9 1H2C1.44771 1 1 1.44771 1 2V18C1 18.5523 1.44771 19 2 19H18C18.5523 19 19 18.5523 19 18V11" stroke="#1E3244" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
        </svg>
    )
}

export default ResizeIcon