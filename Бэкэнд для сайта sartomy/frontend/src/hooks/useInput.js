import {useState} from 'react'

function useInput(initialValue = '', placeholder) {
    const [value, setValue] = useState(initialValue)

    const handleChange = (event) => {
        setValue(event.target.value)
    }



    return {
        value,
        onChange: handleChange,
        placeholder
    }
}

export default useInput
