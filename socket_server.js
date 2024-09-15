// const io = require('socket.io')(3000, {
//     cors: {
//         origin: "*", // Allow all origins (change as necessary)
//     },
// });
//
// io.on('connection', (socket) => {
//     console.log('New client connected:', socket.id);
//
//     // Listen for currency updates from Laravel
//     socket.on('currency-update', (data) => {
//         console.log(data);
//         // Emit updated currency rates to all clients
//         io.emit('currency-update', data);
//     });
//
//     socket.on('disconnect', () => {
//         console.log('Client disconnected:', socket.id);
//     });
// });
