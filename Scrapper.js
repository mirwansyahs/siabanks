function getVideoUrl(){
    async () => {
    await new Promise((resolve, reject) => {
        var totalHeight = 0;
        var distance = 500;
        var timer = setInterval(() => {
            var scrollHeight = document.body.scrollHeight;
            window.scrollBy(0, distance);
            totalHeight += distance;

            if(totalHeight >= scrollHeight){
                clearInterval(timer);
                resolve();
            }
        }, 1   );
    });
    }
    let dataUrl = '';
    let dataClass = document.querySelectorAll('div._53mw');
    for (i = 0; i < dataClass.length; i++){
        let dataStore = JSON.parse(dataClass[i].getAttribute('data-store'));
        dataUrl += dataStore.src+"\n";
    }


    var blob = new Blob([dataUrl], {type: 'text/json'}),
            e    = document.createEvent('MouseEvents'),
            a    = document.createElement('a')
    
        a.download = "dataXxixiix.txt"
        a.href = window.URL.createObjectURL(blob)
        a.dataset.downloadurl =  ['text/json', a.download, a.href].join(':')
        e.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null)
        a.dispatchEvent(e)
}
