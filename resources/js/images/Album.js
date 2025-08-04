export class Album {
    __constructor(NumberOfColumns) {
        const windowWidth = window.innerWidth
        const countOfCols = Math.ceil(windowWidth/initialData.imageMaxWidth)
        for (let i = 0; i<countOfCols; i++) {
            const colDiv = document.createElement('div');
            colDiv.classList.add('col');
            colDiv.id = `col-${i}`;
            colDiv.style.margin = '8px';
            colDiv.style.height = 'min-content'
            const imageContainer = document.getElementById('image-container')
            imageContainer.appendChild(colDiv);
        }
    }
}
