const ws = require('ws')
const express = require('express')
var port = 8080
const expressServer = express()
const ws_server = new ws.Server({
    server: expressServer.listen(8000),
    host: "localhost",
    path: "/"
})
ws_server.on('connection', (w) => {
    console.log('connection established')
    w.on('message', (mes) => {
        console.log('message alert', mes)
        w.send(mes)
    })

})
expressServer.listen( () => console.log('listening...on '+ port))
// node server.js r