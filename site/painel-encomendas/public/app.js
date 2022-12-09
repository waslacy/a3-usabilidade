$.ajax({
	type: "GET",
	url: "http://localhost:8000/encomendas/get",
	dataType: "json",
	success: function (e) {
		atualizaEncomendas(e);
	},
	error: function (e) {
		console.log(e);
	},
});

setInterval(() => {
    $.ajax({
        type: "GET",
        url: "http://localhost:8000/encomendas/get",
        dataType: "json",
        success: function (e) {
            atualizaEncomendas(e);
        },
        error: function (e) {
            console.log(e);
        },
    });
}, 10000);

function atualizaEncomendas(data) {
	let html = "";
	data = JSON.parse(data)
    data.forEach((d) => {
        html += `<div class="col-4 d-flex flex-column justify-content-between p-3 bg-white border rounded gap-4 shadow-sm">`;
        html += `	<h3 class="display-7">Código da encomenda: ${d.codigo}</h3>`;

        html += `	<span style="font-size: 1.1em">Transportadora: ${d.transportadora}</span>`;
        html += `	<span style="font-size: 1.1em">Status: ${d.status}</span>`;
        html += `	<span style="font-size: 1.1em">Última atualização: ${d.ultima_atualizacao}</span>`;

        html += `	<div class="acoes d-flex flex-column gap-2">`;
        html += `		<button class="btn btn-primary" onclick="window.location.href='http://localhost:8000/encomenda/receber/${d.id}'">Recebi minha encomenda</button>`;
        html += `		<button class="btn btn-danger" onclick="window.location.href='http://localhost:8000/encomenda/apagar/${d.id}'">Cancelar rastreamento</button>`;
        html += `	</div>`;
        html += `</div>`;

    });

	$('#encomendas-div').html(html);
}
