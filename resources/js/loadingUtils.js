import {state} from "@/state.js";

const userInTheBottom = () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight;
    const clientHeight = document.documentElement.clientHeight;

    const pixelsFromBottom = scrollHeight - (scrollTop + clientHeight)

    console.log(pixelsFromBottom)

    return (pixelsFromBottom < initialData.scrollThreshold)
}

async function triggerLoadMore (loadFunction, isLoadingField) {
    const loadings = state.isLoading;
    console.log('user in bottom', userInTheBottom())
    console.log('has more pages', state.hasMorePages[isLoadingField])
    console.log('not loading', !loadings[isLoadingField])
    if (userInTheBottom() && state.hasMorePages[isLoadingField] && !loadings[isLoadingField]) {
        loadings[isLoadingField] = true;
        await loadFunction();
        loadings[isLoadingField] = false;
    }
}

export function addListenersToLoadMore(item, loadFunction) {
    window.addEventListener('scroll', async () => {
        triggerLoadMore(loadFunction, item)
    });

    //if scroll bar is absent
    setInterval(() => {
        triggerLoadMore(loadFunction, item)
    }, 500)
}
