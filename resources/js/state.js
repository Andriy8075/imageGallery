export const state = {
    isMobile: (navigator.maxTouchPoints > 0),
    hasMorePages: {
        images: false,
        comments: false,
    },
    lastClickedButton: null,
    isLoading: {
        comments: false,
        images: false,
    }
}
