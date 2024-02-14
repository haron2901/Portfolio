import React from 'react'
import styles from './DrawingCanvasMenu.module.css'

const DrawingCanvasMenu = ({setLineColor, setLineWidth, setLineOpacity}) => {
    return (
        <div className={styles.menu}>
            <label>Brush Color </label>
            <input
                type="color"
                onChange={(e) => {
                    setLineColor(e.target.value)
                }}
            />
            <label>Brush Width </label>
            <input
                type="range"
                min="3"
                max="20"
                onChange={(e) => {
                    setLineWidth(e.target.value)
                }}
            />
            <label>Brush Opacity</label>
            <input
                type="range"
                min="1"
                max="100"
                onChange={(e) => {
                    setLineOpacity(e.target.value / 100)
                }}
            />
        </div>
    )
}

export default DrawingCanvasMenu