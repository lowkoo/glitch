const ws = new WebSocket("ws://localhost:8000")
ws.onopen = () => {
    console.log('connected')
    ws.onmessage = (mes) => {
        console.log("message from server: ", mes)
    }
}