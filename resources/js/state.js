export const state = {
    isMobile: (navigator.maxTouchPoints > 0),
    nextPage: 0,
    lastClickedButton: null,
    loading: {
        comments: false,
        images: false,
    }
}
