import React, {useEffect, useRef, useState} from 'react'
import styles from './DrawingCanvas.module.css'
import DrawingCanvasMenu from "../DrawingCanvasMenu/DrawingCanvasMenu"

const DrawingCanvas = ({isActive}) => {
    const canvasRef = useRef(null)
    const ctxRef = useRef(null)
    const [isDrawing, setIsDrawing] = useState(false)
    const [lineWidth, setLineWidth] = useState(5)
    const [lineColor, setLineColor] = useState("black")
    const [lineOpacity, setLineOpacity] = useState(0.1)

    useEffect(() => {
        const canvas = canvasRef.current
        const ctx = canvas.getContext("2d")
        ctx.lineCap = "round"
        ctx.lineJoin = "round"
        ctx.globalAlpha = lineOpacity
        ctx.strokeStyle = lineColor
        ctx.lineWidth = lineWidth
        ctxRef.current = ctx
    }, [lineColor, lineOpacity, lineWidth])

    const startDrawing = (e) => {
        ctxRef.current.beginPath()
        ctxRef.current.moveTo(
            e.nativeEvent.offsetX,
            e.nativeEvent.offsetY
        )
        setIsDrawing(true)
    }
    const draw = (e) => {
        if (!isDrawing) {
            return
        }
        ctxRef.current.lineTo(
            e.nativeEvent.offsetX,
            e.nativeEvent.offsetY
        )

        ctxRef.current.stroke()
    }

    const endDrawing = () => {
        console.log(ctxRef.current)
        ctxRef.current.closePath()
        setIsDrawing(false)
    }

    function onUndo(e) {
        console.log(e.keyCode)
        e.preventDefault()

        if ((e.keyCode === 90 && e.ctrlKey) || (e.keyCode === 90 && e.keyCode === 91)) {
            console.log('work')
            e.preventDefault()
            undo()
        }
    }

    function undo() {
        console.log('undo')
        console.log('test')
        // const canvas = canvasRef.current
        // const ctx = canvas.getContext("2d")
        // const color = ctx.strokeStyle;
        // ctx.strokeStyle = '#000';
        //
        // if (actions.length === 0) {
        //     ctx.strokeStyle = color;
        //     return;
        // }
        // const action = actions.pop();
        // if (action.type === "move") {
        //     ctx.lineTo(action.x, action.y);
        //     ctx.stroke();
        // }
        // ctx.strokeStyle = color;
    }

    // document.addEventListener("keydown", (e) => onUndo(e))


    return (
        <div className={styles.drawArea}>
            <div style={{display: isActive ? 'block' : 'none'}}>
                <DrawingCanvasMenu
                    setLineColor={setLineColor}
                    setLineWidth={setLineWidth}
                    setLineOpacity={setLineOpacity}
                />
            </div>

            <canvas
                onMouseDown={isActive ? startDrawing : null}
                onMouseUp={isActive ? endDrawing : null}
                onMouseMove={isActive ? draw : null}
                ref={canvasRef}
                width={`1280px`}
                height={`720px`}
            />
        </div>
    )
}

export default DrawingCanvas