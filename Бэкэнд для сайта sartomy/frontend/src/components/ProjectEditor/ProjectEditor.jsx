import React from 'react'
import styles from './ProjectEditor.module.css'
import Input from "../../ui/Input/Input"
import LeftArrowIcon from "../../assets/svg/LeftArrowIcon"
import RightArrowIcon from "../../assets/svg/RightArrowIcon"
import Button from "../../ui/Button/Button"
import ImportIcon from "../../assets/svg/ImportIcon"
import useInput from "../../hooks/useInput"

const ProjectEditor = () => {

    const projNameInput = useInput('', 'test')
    const projRefInput = useInput('', 'test')
    const descriptionTxtArea = useInput('', 'test')
    console.log(descriptionTxtArea.value)

    return (
        <div className={styles.container}>
            <div>
                <p className={styles.inputLabel}>Project Name</p>
                <Input
                    value={projNameInput.value}
                    placeholder={projNameInput.placeholder}
                    onChange={projNameInput.onChange}
                    style={{width: '27.875rem', fontSize: '1.25rem', height: '1rem', padding: '.69rem .31rem'}}
                />
                <p className={styles.inputLabel}>SO References</p>
                <Input
                    value={projRefInput.value}
                    placeholder={projRefInput.placeholder}
                    onChange={projRefInput.onChange}
                    style={{width: '27.875rem', fontSize: '1.25rem', height: '1rem', padding: '.69rem .31rem'}}
                />
                <p className={styles.inputLabel}>Descriptor</p>
                <textarea
                    value={descriptionTxtArea.value}
                    placeholder={descriptionTxtArea.placeholder}
                    onChange={descriptionTxtArea.onChange}
                    className={styles.textArea}
                />
            </div>
            <div className={styles.imagesContainer}>
                <div className={styles.img}>

                </div>
                <div className={styles.imgPagination}>
                    <LeftArrowIcon />
                    <p className={styles.pageNumber}>1</p>
                    <RightArrowIcon />
                </div>
            </div>
            <div>
                <div className={styles.imgInputContainer}>
                    <p className={styles.imgInputLabel}>Front image</p>
                    <Button
                        style={{padding: '.5rem .62rem', justifyContent: 'space-between', width: '6.68rem'}}
                    >
                        Import
                        <ImportIcon width={'1rem'} height={'1rem'}/>
                    </Button>
                </div>
                <div className={styles.imgInputContainer}>
                    <p className={styles.imgInputLabel}>Back image</p>
                    <Button
                        style={{padding: '.5rem .62rem', justifyContent: 'space-between', width: '6.68rem'}}
                    >
                        Import
                        <ImportIcon width={'1rem'} height={'1rem'}/>
                    </Button>
                </div>
                <div className={styles.imgInputContainer}>
                    <p className={styles.imgInputLabel}>Sleeve image</p>
                    <Button
                        style={{padding: '.5rem .62rem', justifyContent: 'space-between', width: '6.68rem'}}
                    >
                        Import
                        <ImportIcon width={'1rem'} height={'1rem'}/>
                    </Button>
                </div>
                <div>
                    <Button
                        style={{padding: '0.625rem 5.3125rem', marginTop: '9rem'}}
                    >
                        Save
                    </Button>
                </div>

            </div>

        </div>
    )
}

export default ProjectEditor