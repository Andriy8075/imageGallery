export const state = {
    isMobile: (navigator.maxTouchPoints > 0),
    hasMorePages: {
        images: false,
        comments: false,
    },
    lastClickedButton: null,
    loading: {
        comments: false,
        images: false,
    }
}
