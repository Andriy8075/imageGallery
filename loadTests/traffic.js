async function calculateResolveTime(i) {
    new Promise(async (resolve)=> {
        const startTime = new Date;
        const data = await fetch('http://localhost/traffic');
        const finishTime = new Date;
        const difference = finishTime - startTime;
        console.log('^^^^^^^^^^^^^^^^^^^^^^^^^^^^^')
        console.log(data.status)
        console.log(difference)
        console.log('number ', i)
        console.log('__________________________')
        console.log('\n')
        resolve()
    })
}
let i = 1
while(true){
    await new Promise(resolve => {
        setTimeout(()=>{
            resolve()
        },2);
    })
    calculateResolveTime(i);
    i++
}
