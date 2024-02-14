import React, {useEffect, useRef, useState} from 'react'
import {fabric} from "fabric"
import styles from './FabricCanvas.module.css'
import useWindowDimensions from "../../hooks/useWindowDimensions"
import html2canvas from "html2canvas"
import jsPDF from "jspdf"
import logo from "../../assets/svg/LogoIcon.svg"
import Button from "../../ui/Button/Button"
import ImportIcon from "../../assets/svg/ImportIcon"
import SavedIcon from "../../assets/svg/SavedIcon"
import NewProjectIcon from "../../assets/svg/NewProjectIcon"
import LeftArrowIcon from "../../assets/svg/LeftArrowIcon"
import RightArrowIcon from "../../assets/svg/RightArrowIcon"
import RotateIcon from "../../assets/svg/RotateIcon"
import MoveIcon from "../../assets/svg/MoveIcon"
import ResizeIcon from "../../assets/svg/ResizeIcon"
import LineIcon from "../../assets/svg/LineIcon"
import TextIcon from "../../assets/svg/TextIcon"
import ColorIcon from "../../assets/svg/ColorIcon"
import PdfIcon from "../../assets/svg/PdfIcon"


const FabricCanvas = ({setSvg, display, canvasId, t_shirt, setPdfImage, svg}) => {
    const [layerStyles, setLayerStyles] = useState([styles.layer])
    const canvasContainerRef = useRef(null)
    const [images, setImages] = useState([])
    const canvasRef = useRef()
    const inputFileRef = useRef()
    const [canvas, setCanvas] = useState(null)
    const [currentMode, setCurrentMode] = useState('')
    const [pressed, setPressed] = useState(false)
    const [activeColor, setActiveColor] = useState('#000000')
    const [fontLabel, setFontLabel] = useState('arial')
    const [sizeLabel, setSizeLabel] = useState(20)
    const [colorLabel, setColorLabel] = useState('#000000')
    const {width} = useWindowDimensions()

    const imgAdded = (e) => {
        const reader = new FileReader()
        const image = inputFileRef.current.files[0]
        // console.log(image)
        reader.readAsDataURL(image)
        reader.addEventListener('load', () => {
            fabric.Image.fromURL(reader.result, img => {
                img.scaleToWidth(150)
                canvas.add(img)
                canvas.renderAll()
            })
        })
    }

    const setProperties = (canvas) => {
        canvas.on('mouse:down', (e) => {
            if (pressed && currentMode === 'draw') {
                canvas.freeDrawingBrush.color = activeColor
                canvas.renderAll()

            }
        })
        canvas.on('mouse:up', (e) => {
            setPressed(false)
            setSvg(canvas.toSVG())



        })
        canvas.on('mouse:move', (e) => {
            setSvg(canvas.toSVG())
            setPressed(true)


        })
        // fabric.Image.fromURL(t_shirt, function (img) {
        //     canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
        //         scaleX: canvas.width / img.width,
        //         scaleY: canvas.height / img.height
        //     })
        //     canvas.renderAll()
        // })
    }

    const addLabel = () => {
        const text = new fabric.IText('label', {
            left: 10,
            top: 10,
            fontFamily: fontLabel,
            fill: colorLabel,
            fontSize: sizeLabel
        })
        canvas.add(text)
    }

    const undo = () => {
        canvas.getObjects().forEach((obj, index) => {
            if (index === canvas.getObjects().length - 1) {
                canvas.remove(obj)
            }
        })
    }


    const setMode = (mode) => {
        if (mode === 'draw') {
            if (currentMode === mode) {
                setCurrentMode('draw')
                canvas.isDrawingMode = false
            } else {
                setCurrentMode(mode)
                canvas.isDrawingMode = true
            }
        }
    }
    const initCanvas = (id) => {
        return new fabric.Canvas(id, {
            width: (width / 100) * 1.1 * 75,
            height: (width / 100) * 1.1 * 31.25,
            selection: false
        })
    }

    const rubber = () => {
        setActiveColor('#fff')
    }


    useEffect(() => {
        setCanvas(initCanvas(canvasRef.current.id))
    }, [])

    useEffect(() => {
        if (canvas) {
            setProperties(canvas)
        }

    }, [canvas, activeColor])

    const clearCanvas = (canvas) => {
        canvas.getObjects().forEach(obj => {
            if (obj !== canvas.backgroundImage) {
                canvas.remove(obj)
            }
        })
    }

    const onclick = () => {

    }
    const changeActiveLayer = () => {
        if (layerStyles.includes(styles.activeLayer)) {
            setLayerStyles([layerStyles[0]])
            return
        }
        setLayerStyles([...layerStyles, styles.activeLayer])
    }




    useEffect(() => {
        if (canvas) {
            const img = canvas.toDataURL("image/jpeg", 1.0)
            setPdfImage(img)
            canvas.renderAll()
        }

    }, [svg])

    return (
        <div style={{display: display}} >
            <div className={styles.tools}>
                <div onClick={() => setImages([...images, logo])}>
                    <Button
                        style={{padding: '.5rem .62rem', justifyContent: 'space-between', width: '9.56rem'}}
                    >
                        <label htmlFor={'file'}>Upload logo</label>
                        <ImportIcon width={'1rem'} height={'1rem'}/>
                    </Button>
                    <input type={"file"} id={'file'} onChange={imgAdded} ref={inputFileRef} style={{display: 'none'}}/>

                </div>

                <div className={styles.projectTools}>

                    <SavedIcon height={'1.5rem'} width={'1.5rem'}/>
                    <NewProjectIcon height={'1.5rem'} width={'1.5rem'}/>
                    <select onChange={e => setFontLabel(e.target.value)}>
                        <option value="arial">arial</option>
                        <option value="comic sans ms">comic sans ms</option>

                    </select>
                    <input type={'number'} onChange={e => setSizeLabel(+e.target.value)} value={sizeLabel}/>
                    <input type={'color'} onChange={e => setColorLabel(e.target.value)} value={colorLabel}/>
                </div>
                <div className={styles.paintTools}>
                    <div onClick={undo}>
                        <LeftArrowIcon height={'1.5rem'} width={'1.5rem'}/>
                    </div>
                    <RightArrowIcon height={'1.5rem'} width={'1.5rem'}/>
                    <RotateIcon height={'1.5rem'} width={'1.5rem'}/>
                    <MoveIcon height={'1.5rem'} width={'1.5rem'}/>
                    <ResizeIcon height={'1.5rem'} width={'1.5rem'}/>
                    <div onClick={() => setMode('draw')}>
                        <LineIcon height={'1.5rem'} width={'1.5rem'}/>
                    </div>
                    <div onClick={addLabel}>
                        <TextIcon height={'1.5rem'} width={'1.5rem'}/>
                    </div>

                    <ColorIcon height={'1.5rem'} width={'1.5rem'}/>

                </div>
            </div>
            <div
                className={styles.canvas}
                ref={canvasContainerRef}
            >
                <img src={t_shirt} className={styles.tShirtImg} alt={'t-shirt'}/>

                <canvas ref={canvasRef} id={canvasId}/>

            </div>
        </div>

    )
}

export default FabricCanvas