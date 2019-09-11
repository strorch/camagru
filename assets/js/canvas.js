class Canvas
{
    //TODO: drag and drop http://luke.breuer.com/tutorial/javascript-drag-and-drop-tutorial.aspx
    /**
     * @param image
     * @returns {HTMLCanvasElement}
     */
    convertImageToCanvas(image)
    {
        let canvas = document.createElement("canvas");
        canvas.width = image.width;
        canvas.height = image.height;
        canvas.getContext("2d").drawImage(image, 0, 0);
        return canvas;
    }

    /**
     * @param canvas
     * @returns {HTMLImageElement}
     */
    convertCanvasToImage(canvas)
    {
        let image = new Image();
        image.src = canvas.toDataURL("image/png");
        return image;
    }
}
