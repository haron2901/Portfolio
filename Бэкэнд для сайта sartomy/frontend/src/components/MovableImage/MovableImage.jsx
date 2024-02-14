import React, {useRef, useState} from 'react'


const MovableImage = ({src, canvasRef, className}) => {
    const [isDragging, setIsDragging] = useState(false)
    const [imgCoords, setImgCoords] = useState([0, 0])
    const imgRef = useRef(null)

    const handleMouseDown = () => {
        setIsDragging(true)
    }

    const handleMouseUp = () => {
        setIsDragging(false)
    }

    const handleMouseMove = (event) => {
        if (isDragging) {
            if (canvasRef.current && imgRef.current) {
                const rect = canvasRef.current.getBoundingClientRect()
                const rectImg = imgRef.current.getBoundingClientRect()


                const x = event.clientX - rect.left - (rectImg.width / 2)
                const y = event.clientY - rect.top - (rectImg.height / 2)


                setImgCoords([x, y])
            }
        }
    }

    return (
        <img
            src={src}
            alt={'src'}
            className={className}
            style={{left: imgCoords[0], top: imgCoords[1], cursor: isDragging ? 'grabbing' : 'grab', zIndex: isDragging ? '2' : '1'}}
            ref={imgRef}
            onMouseDown={handleMouseDown}
            onMouseUp={handleMouseUp}
            onMouseMove={handleMouseMove}
            onDragStart={e => e.preventDefault()}

        />
    )
}

export default MovableImage