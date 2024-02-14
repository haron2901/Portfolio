const defaultState = {
    isAuth: false,

}

const LOGIN = 'LOGIN'


export const reducer = (state = defaultState, action) => {
    switch (action.type){
        case LOGIN:
            return {...state, isAuth: action.payload}
        default:
            return state
    }
}

export const loginAction = (bool) => ({type: LOGIN, payload: bool})
