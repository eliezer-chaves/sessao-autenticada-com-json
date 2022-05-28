<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestão de Atividades</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
	body {
		margin: 1px;
		background-color: #c1c1c1;
	}
</style>

<body id="body">
	<div class="container">
		<div class="row mt-5">
			<b>
				<h3 class="text-center" id="resultadoLogado">
				</h3>
			</b>
			<div class="d-flex justify-content-center">
				<a href="#" id="fechar_sessao" class="btn btn-outline-dark text-center">Logout</a>
			</div>
		</div>
		<div class="row mt-5">
			<table id="table" class="table table-light table-striped table-bordered">
				<thead class="table-dark table-bordered">
					<tr>
						<th scope="col">#</th>
						<th scope="col" class="text-center align-middle" style="width: 60%;">Atividade</th>
						<th scope="col" class="text-center align-middle" style="width: 25%;">Data</th>
						<th scope="col" class="text-center align-middle" style="width: 15%;">Operações</th>
					</tr>
				</thead>
				<tbody id="atividades" class="table-bordered align-middle">

				</tbody>
				<tfoot style="border-top: 2px solid black;">
					<tr>
						<td class="text-center align-middle" scope="row" colspan="4">
							<button class="btn add" id="add"><i class="fa-solid fa-plus" style="color: green;"></i></button>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

	<!-- Modal Criar Item-->
	<div id="myModalCriar" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nova Atividade</h4>
				</div>
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroup-sizing-default">Atividade</span>
						</div>
						<input type="text" id="txtCriarAtividade" class="form-control" aria-label="Atividade" aria-describedby="inputGroup-sizing-default">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-criar" data-dismiss="modal">Criar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Editar -->
	<div id="myModalEditar" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Modificar Atividade</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="rowEdit">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroup-sizing-default">Atividade</span>
						</div>
						<input type="text" id="txtModificarAtividade" class="form-control" aria-label="Atividade" aria-describedby="inputGroup-sizing-default">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-editar" data-dismiss="modal">Atualizar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Deletar Item-->
	<div id="myModalDeletar" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="deleteAtividade"></h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="rowDelete">
					<p>Confirmar exclusão?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-deletar-nao" data-dismiss="modal">Não</button>
					<button type="button" class="btn btn-primary btn-deletar-sim" data-dismiss="modal">Sim</button>
				</div>
			</div>
		</div>
	</div>

	<!--Modal de Login -->
	<div id="myModalLogin" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header text-center d-flex justify-content-center">
					<h4 class="modal-title text-center">Faça seu Login</h4>
				</div>
				<div class="container">
					<div class="row">
						<div class="input-group mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default">Login</span>
							</div>
							<input id="login" name="login" type="text" class="form-control" aria-label="Login" aria-describedby="inputGroup-sizing-default" required>
						</div>
					</div>
					<div class="row ">
						<div class="input-group mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-default">Password</span>
							</div>
							<input id="password" name="password" type="password" class="form-control" aria-label="Password" aria-describedby="inputGroup-sizing-default" required>
						</div>
					</div>
				</div>


				<div class="text-center mb-2" id="resultado"></div>

				<div class="modal-footer d-flex justify-content-center">
					<a href="#" id="abrir_sessao" class="btn btn-dark ">Login</a>
				</div>
			</div>
		</div>
	</div>

	<script>
		var minhasAtividades;
		var quantidade;

		$(document).ready(function() {
			$.ajax({
				method: "POST",
				url: "../backend/session_manager_auth.php",
				data: {
					operation: "load"
				}
			}).done(function(resposta) {
				var obj = $.parseJSON(resposta);
				if (obj.nome != 'undefined') {
					$('#myModalLogin').modal('hide');
					$("#nome").val(obj.nome);
					$("#login").val(obj.login);
					$("#resultadoLogado").html("Bem vindo, " + obj.nome + "!");
					$("#fechar_sessao").toggle(true);
					$("#abrir_sessao").toggle(false);
					$("#table").show();
					$("#body").removeClass("bg-dark");
					loadData();

				} else if (obj.nome == 'undefined') {
					$('#myModalLogin').data()
					$('#myModalLogin').modal('show');
					$("#myModalLogin").modal({
						escapeClose: false,
						clickClose: false,
						showClose: false
					});
					$("#resultadoLogado").html("");
					$("#fechar_sessao").toggle(false);
					$("#abrir_sessao").toggle(true);
					$("#table").hide();
					$("body").addClass("bg-dark");
					loadData();
				}
			});
		});


		$("#abrir_sessao").click(function() {
			if ($("#login").val() == "" || $("#password").val() == "") {
				$("#resultado").html("Preencha todos os campos");
				setTimeout(function() {
					$("#resultado").html("");
				}, 1000);
				

			} else {
				
				var v2 = $("#login").val()
				var v3 = $("#password").val()
				$.ajax({
					method: "POST",
					url: "../backend/session_manager_auth.php",
					data: {
						operation: "login"
					},
					beforeSend: function(xhr) {
						xhr.setRequestHeader("Authorization", "Basic " + btoa(v2 + ":" + v3));

					},
					error: function(xhr) {
						$("#resultado").html("Usuário e/ou senha inválidos.");
						$("#password").val("");
						$("#login").val("");
					}
				}, ).done(function(resposta) {
					
					var obj = $.parseJSON(resposta);
					if (obj.status == 'logado') {
						$('#myModalLogin').modal('hide');
						$("#nome").val(obj.nome);
						$("#login").val(obj.login);
						$("#password").val("");
						$("#resultadoLogado").html("Bem vindo, " + obj.nome + "!");
						$("#table").show();
						$("#body").removeClass("bg-dark");
						$("#fechar_sessao").toggle(true);
						$("#abrir_sessao").toggle(false);
						loadData()
					}
				});
			}


		});

		$("#fechar_sessao").click(function() {
			$.ajax({
				method: "POST",
				url: "../backend/session_manager_auth.php",
				data: {
					operation: "logout"
				}
			}).done(function(resposta) {
				var obj = $.parseJSON(resposta);

				if (obj.nome == 'undefined') {
					$("#nome").val("");
					$("#login").val("");
					$("#password").val("");
					$("#resultadoLogado").html("");
					$("#fechar_sessao").toggle(false);
					$("#abrir_sessao").toggle(true);
					$("#resultado").html("");
					$("#table").hide();
					$("body").addClass("bg-dark");

					$('#myModalLogin').data()
					$("#myModalLogin").modal('show');
					$("#myModalLogin").modal({
						escapeClose: false,
						clickClose: false,
						showClose: false
					});
				}
			});
		});

		lerSessao();

		function lerSessao() {
			if (quantidade != null) {
				loadData();
			} else {
				quantidade = 0;
			}
		}

		function paddingDate(item) {
			if (item.toString().length == 1) {
				return '0' + item;
			} else {
				return item;
			}
		}

		function getDate() {
			var date = new Date();
			return paddingDate(date.getDate()) + '/' +
				paddingDate((date.getMonth() + 1)) + '/' +
				paddingDate(date.getFullYear()) + ' - ' +
				paddingDate(date.getHours()) + ':' +
				paddingDate(date.getMinutes()) + ':' +
				paddingDate(date.getSeconds());
		}

		function markDone(row) {
			var index = row;
			$.ajax({
				method: "POST",
				url: "../backend/session_manager_auth.php",
				data: {
					operation: "markDoneAtividade",
					index: index,
					status: "done"
				}
			}).done(function(resposta) {
				var obj = $.parseJSON(resposta);
				if (obj.resultado == 'concluida') {
					loadData();
				}
			});
		}

		function deleteItem(row) {
			var index = row;

			$.ajax({
				method: "POST",
				url: "../backend/session_manager_auth.php",
				data: {
					operation: "deleteAtividade",
					index: index
				}
			}).done(function(resposta) {
				var obj = $.parseJSON(resposta);
				if (obj.resultado == 'deletado') {
					$("#myModalDeletar").modal('hide');
					loadData();
				}
			});

		}

		function editItem(row, txt_atividade) {
			var datestring = getDate();
			var index = row;
			var atividadeEditada = txt_atividade

			$.ajax({
				method: "POST",
				url: "../backend/session_manager_auth.php",
				data: {
					operation: "editAtividade",
					index: index,
					atividade: atividadeEditada,
					newDate: datestring
				}
			}).done(function(resposta) {

				var obj = $.parseJSON(resposta);

				if (obj.resultado == 'editado') {
					$("#myModalEditar").modal('hide');
					loadData();
				}
			});

		}

		function addItem(txt_atividade) {
			var datestring = getDate();
			var newRow = 1;
			if ($('#atividades tr:last')[0]) {
				newRow = parseInt($('#atividades tr:last')[0].id.replace("row", "")) + 1;
			}
			var atividade = {
				index: newRow,
				atividade: txt_atividade,
				date: datestring,
				status: "open"
			};
			$.ajax({
				method: "POST",
				url: "../backend/session_manager_auth.php",
				data: {
					operation: "addAtividade",
					novaAtividade: atividade
				}
			}).done(function(resposta) {

				var obj = $.parseJSON(resposta);
				if (obj.resultado == 'adicionado') {
					$("#myModalCriar").modal('hide');
				}
			});
			loadData();
		}

		function loadData() {
			$.ajax({
				method: "POST",
				url: "../backend/session_manager_auth.php",
				data: {
					operation: "load"
				}
			}).done(function(resposta) {
				var obj = $.parseJSON(resposta);
				var minhasAtividades = obj.atividades

				if (obj.nome != 'undefined') {
					$('#atividades').empty();
					var count_atividades = 0;
					if (minhasAtividades.length > 0) {
						for (var i = 0; i < minhasAtividades.length; i++) {
							var newRow = minhasAtividades[i].index;
							var atividade = minhasAtividades[i].atividade;
							var datestring = minhasAtividades[i].date;

							var nova_linha = '';

							count_atividades = count_atividades + 1;
							if (minhasAtividades[i].status == "open") {
								nova_linha =
									'<tr class="text-center align-midle" id="row' + newRow + '">' +
									'<th class="text-center align-midle" scope="row">' + newRow + '</th>' +
									'<td class="text-center align-midle" id="content' + newRow + '">' + atividade + '</td>' +
									'<td class="text-center align-midle">' + datestring + '</td>' +
									'<td class="text-center align-midle" >' +
									'<button class="btn edit" id="edit' + newRow + '"><i class="fa-solid fa-file-pen" style="color: blue;"></i></button>' +
									'<button class="btn delete" id="delete' + newRow + '"><i class="fa fa-trash" style="color: red;"></i></button>' +
									'<button class="btn done" id="done' + newRow + '"><i class="fa-solid fa-check" style="color: green;"></i></button>' +
									'</td>' +
									'</tr>';
							} else if (minhasAtividades[i].status == "done") {
								nova_linha =
									'<tr class="text-center align-midle table-Warning" id="row' + newRow + '">' +
									'<th class="text-center align-midle" scope="row">' + newRow + '</th>' +
									'<td class="text-center align-midle" id="content' + newRow + '">' + atividade + '</td>' +
									'<td class="text-center align-midle">' + datestring + '</td>' +
									'<td class="text-center" >' +
									'<button class="btn delete" id="delete' + newRow + '"><i class="fa fa-trash" style="color: red;"></i></button>' +
									'</td>' +
									'</tr>';

							}

							$('#atividades').append(nova_linha);
						}

					}
					quantidade = count_atividades;
				}
			});
		}

		$('.btn-criar').click(function() {
			addItem($("#txtCriarAtividade").val());
			$("#txtCriarAtividade").val("");
		});

		$('.btn-editar').click(function() {
			editItem(
				$("#rowEdit").val(),
				$("#txtModificarAtividade").val()
			);

			$("#rowEdit").val("");
			$("#txtModificarAtividade").val("");
		});

		$('.btn-deletar-sim').click(function() {
			deleteItem(
				$("#rowDelete").val()
			);

			$("#rowDelete").val("");
			$("#deleteAtividade").text("");
		});

		$(document).on("click", 'button', function(element) {
			var id = element.currentTarget.id;

			if (id.includes("edit")) {
				var row = id.replace("edit", "");
				var contentId = "#content" + row;
				$("#txtModificarAtividade").val($(contentId).html());
				$("#rowEdit").val(row);
				$('#myModalEditar').modal('show');
			} else if (id.includes("delete")) {
				var row = id.replace("delete", "");
				var contentId = "#content" + row;
				$("#deleteAtividade").text($(contentId).html());
				$("#rowDelete").val(row);
				$('#myModalDeletar').modal('show');
			} else if (id.includes("add")) {
				$('#myModalCriar').modal('show');
			} else if (id.includes("done")) {
				var row = id.replace("done", "");
				markDone(row);
			}
		});
	</script>
</body>

</html