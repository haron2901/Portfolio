import React from 'react'

const ProductIcon = ({width, height}) => {

    return (
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" style={{width: width, height: height}}>
            <g clipPath="url(#clip0_11_140)">
                <path
                    d="M15.2953 10.2563C15.2953 11.2172 14.5125 12 13.5516 12H10.2563V8.5125H13.5516C14.5125 8.5125 15.2953 9.29531 15.2953 10.2563ZM23.625 12C23.625 18.4219 18.4219 23.625 12 23.625C5.57812 23.625 0.375 18.4219 0.375 12C0.375 5.57812 5.57812 0.375 12 0.375C18.4219 0.375 23.625 5.57812 23.625 12ZM17.6203 10.2563C17.6203 8.01094 15.7969 6.1875 13.5516 6.1875H7.93125V17.8125H10.2563V14.325H13.5516C15.7969 14.325 17.6203 12.5016 17.6203 10.2563Z"
                    fill="black"/>
            </g>
            <defs>
                <clipPath id="clip0_11_140">
                    <rect width="24" height="24" fill="white"/>
                </clipPath>
            </defs>
        </svg>
    )
}

export default ProductIcon