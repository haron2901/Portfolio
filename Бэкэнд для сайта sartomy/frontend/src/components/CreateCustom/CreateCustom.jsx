import React, {useEffect, useRef, useState} from 'react'
import styles from './CreateCustom.module.css'
import Checkbox from "../Checkbox/Checkbox"
import t_shirt1 from '../../assets/png/t-shirt-1.jpeg'
import t_shirt2 from '../../assets/png/t-shirt-2.jpeg'
import t_shirt3 from '../../assets/png/t-shirt-3.jpeg'
import FabricCanvas from "../FabricCanvas/FabricCanvas"
import Error from "../Error/Error"
import PdfIcon from "../../assets/svg/PdfIcon"
import html2canvas from "html2canvas"
import jsPDF from "jspdf"

const CreateCustom = () => {

    const [layerStyles, setLayerStyles] = useState([styles.layer])
    const [activeLayer, setActiveLayer] = useState(1)
    const [firstSvg, setFirstSvg] = useState('')
    const [secondSvg, setSecondSvg] = useState('')
    const [thirdSvg, setThirdSvg] = useState('')
    const [isError, setIsError] = useState(false)
    const [firstPdfImage, setFirstPdfImage] = useState('')
    const [secondPdfImage, setSecondPdfImage] = useState('')
    const [thirdPdfImage, setThirdPdfImage] = useState('')



    const changeActiveLayer = (layerId) => {
        if (layerStyles.includes(styles.activeLayer)) {
            setLayerStyles([layerStyles[0]])
            return
        }
        setLayerStyles([...layerStyles, styles.activeLayer])
        setActiveLayer(layerId)
    }


    const generatePdf = () => {

        const pdf = new jsPDF()

        pdf.addImage(firstPdfImage, 'JPEG', 25, 0, 150, 62.5)
        pdf.addImage(secondPdfImage, 'JPEG', 25, 70, 150, 62.5)
        pdf.addImage(thirdPdfImage, 'JPEG', 25, 140, 150, 62.5)
        pdf.save("download.pdf")


    }


    useEffect(() => {
        // window.addEventListener('keypress', e => {
        //     console.log(e.key)
        //     // if
        // })
    }, [])

    return (
        <div className={styles.container} onClick={() => setIsError(!isError)}>
            {/*<Error isError={isError} />*/}
            <FabricCanvas
                setSvg={setFirstSvg}
                display={activeLayer === 1 ? 'block' : 'none'}
                canvasId={'canvas1'}
                t_shirt={t_shirt1}
                setPdfImage={setFirstPdfImage}
                svg={firstSvg}
            />
            <FabricCanvas
                setSvg={setSecondSvg}
                display={activeLayer === 2 ? 'block' : 'none'}
                canvasId={'canvas2'}
                t_shirt={t_shirt2}
                setPdfImage={setSecondPdfImage}
                svg={secondSvg}
            />
            <FabricCanvas
                setSvg={setThirdSvg}
                display={activeLayer === 3 ? 'block' : 'none'}
                canvasId={'canvas3'}
                t_shirt={t_shirt3}
                setPdfImage={setThirdPdfImage}
                svg={thirdSvg}

            />

            <div onClick={generatePdf} className={styles.pdfIcon}>
                <PdfIcon height={'1.5rem'} width={'1.5rem'}/>
            </div>

            <div className={styles.layerContainer}>
                <div className={styles.layer} onClick={() => changeActiveLayer(1)}>
                    <div className={styles.checkbox}>
                        <Checkbox isActive={activeLayer === 1}/>
                    </div>
                    <img src={t_shirt1} className={styles.layerImg}/>
                    <div dangerouslySetInnerHTML={{__html: firstSvg}} className={styles.canvasSvg}></div>
                </div>
                <div className={styles.layer} onClick={() => changeActiveLayer(2)}>
                    <div className={styles.checkbox}>
                        <Checkbox isActive={activeLayer === 2}/>
                    </div>
                    <img src={t_shirt2} className={styles.layerImg}/>
                    <div dangerouslySetInnerHTML={{__html: secondSvg}} className={styles.canvasSvg}></div>

                </div>
                <div className={styles.layer} onClick={() => changeActiveLayer(3)}>
                    <div className={styles.checkbox}>
                        <Checkbox isActive={activeLayer === 3}/>
                    </div>
                    <img src={t_shirt3} className={styles.layerImg}/>
                    <div dangerouslySetInnerHTML={{__html: thirdSvg}} className={styles.canvasSvg}></div>

                </div>
            </div>
        </div>
    )
}

export default CreateCustom