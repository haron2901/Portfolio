import {CREATE_CUSTOM_ROUTE, PRODUCTS_ROUTE, PROJECTS_ROUTE, QUICK_TOOL_ROUTE} from "./consts"
import Products from "../components/Products/Products"
import CreateCustom from "../components/CreateCustom/CreateCustom"
import Projects from "../components/Projects/Projects"
import QuickTool from "../components/QuickTool/QuickTool"

export const routes = [
    {
        path: PRODUCTS_ROUTE,
        Component: Products
    },
    {
        path: CREATE_CUSTOM_ROUTE,
        Component: CreateCustom
    },
    {
        path: PROJECTS_ROUTE,
        Component: Projects
    },
    {
        path: QUICK_TOOL_ROUTE,
        Component: QuickTool
    },
]