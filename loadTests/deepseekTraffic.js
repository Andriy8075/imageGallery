import https from 'https';
import axios from 'axios';
const url = 'https://localhost:80/traffic'; // Replace with your target URL

let requestCount = 0;
const requestInterval = 10; // Milliseconds

async function makeRequest() {
    const startTime = Date.now();
    requestCount++;

    try {
        const response = await axios.get(url, {
            httpsAgent: new https.Agent({ rejectUnauthorized: false })
        });
        const endTime = Date.now();
        const duration = endTime - startTime;

        console.log(`Request #${requestCount}:`);
        console.log(`  Start: ${new Date(startTime).toISOString()}`);
        console.log(`  End:   ${new Date(endTime).toISOString()}`);
        console.log(`  Duration: ${duration}ms`);
        console.log(`  Status: ${response.status}`);
        console.log('----------------------------------');
    } catch (error) {
        const endTime = Date.now();
        console.log(`Request #${requestCount} failed after ${endTime - startTime}ms`);
        console.error(error.message);
    }
}

// Start making requests
const intervalId = setInterval(makeRequest, requestInterval);

// Stop after 1000 requests (optional)
setTimeout(() => {
    clearInterval(intervalId);
    console.log('Stopped after 1000 requests');
}, 1000 * 1000); // 1000 requests * 10ms interval ≈ 10 seconds

process.on('SIGINT', () => {
    clearInterval(intervalId);
    console.log('\nStopped by user');
    process.exit();
});
