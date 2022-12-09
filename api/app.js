const express = require("express");
const {consultarCep, calcularPrecoPrazo, rastrearEncomendas}  = require("correios-brasil");
const cors = require("cors");
const { response, json } = require("express");
const bodyParser = require("body-parser");
const app = new express();


app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());


app.post('/correios', (req, res) => {
    let encomendas = JSON.parse(req.body.encomendas)

    rastrearEncomendas(encomendas).then(response => {
        if(!response[0].mensagem){
            res.send(response[0].eventos);
        } else {
            let arr = []
            response.map((r) => {
                let json = {
                    'cod': response[0].codObjeto,
                    'status': response[0].mensagem
                }

                arr.push(json)
            })

            arr = JSON.stringify(arr)
            res.send(arr)
        }
    });
})

app.listen(3000, () => console.log('listening'))