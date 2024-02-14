import React, {useEffect, useState} from 'react'
import styles from './Products.module.css'
import Button from "../../ui/Button/Button"
import axios from "axios"

const Products = () => {

    const [products, setProducts] = useState([])
    const [pageNumber, setPageNumber] = useState(1)
    const [totalCount, setTotalCount] = useState(0)
    const [totalPagesCount, setTotalPagesCount] = useState(null)


    const nextPage = () => {
        pageNumber === totalPagesCount ?
            setPageNumber(pageNumber)
            :
            setPageNumber(pageNumber + 1)
    }

    const prevPage = () => {
        pageNumber === 1 ?
            setPageNumber(1)
            :
            setPageNumber(pageNumber - 1)

    }

    const getProducts = async () => {
        const response = await axios.get('https://jsonplaceholder.typicode.com/users', {
            params: {
                _limit: 5,
                _page: pageNumber
            },

        })
        setTotalCount(+response.headers['x-total-count'])
        const data = response.data
        const totalPagesCount = Math.ceil(totalCount / 5)
        setTotalPagesCount(totalPagesCount)

        setProducts(data)
    }

    useEffect(() => {
        getProducts()
    }, [pageNumber])






    return (
        <div className={styles.container}>
            <Button

                style={{fontSize: '1.0625rem', padding: '0.5rem 0.875rem', borderRadius: '.5rem', width: '5.8125rem'}}
            >
                Update
            </Button>
            <table className={styles.table}>
                <thead>
                <tr>
                    <td className={styles.tableRowTitle}>Product Name</td>
                    <td className={styles.tableRowTitle}>Product Image</td>
                    <td className={styles.tableRowTitle}>Category</td>
                    <td className={styles.tableRowTitle}>Subcategory</td>
                    <td className={styles.tableRowTitle}>Create custom</td>
                </tr>
                </thead>
                <tbody>
                {products.map(item =>
                    <tr className={styles.tableRow} key={item.id}>
                        <td className={styles.tableItem}>Test</td>
                        <td className={styles.tableItem}>
                            <div className={styles.productImg}></div>
                        </td>
                        <td className={styles.tableItem}>{item.username}</td>
                        <td className={styles.tableItem}>{item.address.city}</td>
                        <td className={styles.tableItem}>
                            <Button
                                style={{fontSize: '1.0625rem', padding: '0.5rem 0.875rem', borderRadius: '.5rem'}}
                            >Create custom</Button>
                        </td>
                    </tr>
                )}
                </tbody>
            </table>
            <div className={styles.bottomContainer}>
                <div className={styles.pageNavContainer}>
                    <Button
                        style={{fontSize: '1.0625rem', padding: '0.5rem 0.875rem', borderRadius: '.5rem'}}
                        onClick={prevPage}
                    >Previous</Button>
                    <p className={styles.pageNumber}>{pageNumber}</p>
                    <Button
                        style={{fontSize: '1.0625rem', padding: '0.5rem 0.875rem', borderRadius: '.5rem'}}
                        onClick={nextPage}
                    >Next</Button>
                </div>
                <span className={styles.amountLabel}>Amount of goods 5</span>
            </div>
        </div>
    )
}

export default Products