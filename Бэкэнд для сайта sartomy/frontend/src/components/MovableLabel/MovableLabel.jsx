import React, {useRef, useState} from 'react'
import useInput from "../../hooks/useInput"


const MovableLabel = ({canvasRef, className, id}) => {
    const [labelCoords, setLabelCoords] = useState([0, 0])
    const labelRef = useRef(null)
    const [isActive, setIsActive] = useState(false)
    const [isFocus, setIsFocus] = useState(false)
    const input = useInput(`label${id}`, '')

    function handleClick() {
        setIsFocus(true)
        console.log('doubleclick')
        labelRef.current.focus()
    }

    const handleMouseDown = () => {
        if (!isActive) {
            setIsActive(true)
        }
    }

    const handleMouseUp = () => {
        setIsActive(false)
    }

    const handleMouseMove = (event) => {
        if (isActive) {

            if (canvasRef.current && labelRef.current) {
                const rect = canvasRef.current.getBoundingClientRect()
                const rectLabel = labelRef.current.getBoundingClientRect()


                const x = event.clientX - rect.left - (rectLabel.width / 2)
                const y = event.clientY - rect.top - (rectLabel.height / 2)


                setLabelCoords([x, y])
            }
        }
    }




    return (
        <input
            className={className}
            style={{
                left: labelCoords[0],
                top: labelCoords[1],
                border: isActive ? '1px solid red' : isFocus ? '1px solid green' : '1px solid black',
                zIndex: isActive ? '2' : '1',
                width: input.value.length + 'ch',
                cursor: isActive ? 'grabbing' : isFocus ? 'text' : 'grab'

            }}
            onChange={input.onChange}
            value={input.value}
            ref={labelRef}
            onMouseDown={handleMouseDown}
            onMouseUp={handleMouseUp}
            onMouseMove={handleMouseMove}
            onDragStart={e => e.preventDefault()}
            onClick={handleClick}
            readOnly={!isFocus}
            onBlur={() => setIsFocus(false)}

        />

    )
}

export default MovableLabel