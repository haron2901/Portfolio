import React, {useState} from 'react'

const ResizableImage = ({initialSize}) => {
    const [size, setSize] = useState(initialSize)
    const [dragging, setDragging] = useState(false)

    const handleMouseDown = (e) => {
        e.preventDefault()
        setDragging(true)

        const startX = e.clientX
        const startY = e.clientY

        const handleMouseMove = (e) => {
            if (dragging) {
                const deltaX = e.clientX - startX
                const deltaY = e.clientY - startY

                setSize({
                    width: size.width + deltaX,
                    height: size.height + deltaY,
                })
            }
        }

        const handleMouseUp = () => {
            setDragging(false)
            document.removeEventListener('mousemove', handleMouseMove)
            document.removeEventListener('mouseup', handleMouseUp)
        }

        document.addEventListener('mousemove', handleMouseMove)
        document.addEventListener('mouseup', handleMouseUp)
    }

    return (
        <div
            style={{
                position: 'absolute',
                top: 0,
                left: 0,
                width: size.width,
                height: size.height,
                border: '1px solid #ccc',
                overflow: 'hidden',
            }}
        >
            <img
                src='./assets/svg/LogoIcon.svg'
                alt="Resizable Image"
                style={{width: size.width,
                    height: size.height, cursor: 'se-resize'}}
                onMouseDown={handleMouseDown}
            />
        </div>
    )
}

export default ResizableImage
